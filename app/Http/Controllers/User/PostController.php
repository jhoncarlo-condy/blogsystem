<?php

namespace App\Http\Controllers\User;
use App\Post;
use App\User;
use App\Comment;
use App\Category;
use App\Events\AddPostEvent;
use Illuminate\Http\Request;
use App\Events\DeletePostEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    public function index()
    {
        $query = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'image',
            'created_at');
        $posts = $query->orderBy('id','desc')->paginate(6);
        $latest = $query->orderBy('id','desc')->take(3)->get();
        $auth = Auth::user();
        if ($auth) {
            $myrecent = $query->where('user_id', $auth->id)
                        ->orderBy('created_at','desc')->get();
        }
        else {
            $myrecent = '';
        }
        $categories = Category::select(
            'id',
            'title')
            ->take(4)->get();
        return view('users.posts.index')->with([
            'posts'=>$posts,
            'latest'=>$latest,
            'myrecent'=>$myrecent,
            'categories'=>$categories,
        ]);
    }
    public function realtimeuserpost()
    {
        $posts = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'image',
            'created_at')
            ->orderBy('id','desc')->paginate(6);
        return view('users.posts.realtimeposts')->with([
            'posts'=>$posts
        ]);
    }
    public function realtimelatestpost()
    {
        $latest = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'image',
            'created_at')
            ->orderBy('id','desc')->take(3)->get();
        return view('users.posts.realtimelatestpost')->with([
            'latest'=>$latest
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required|same:category',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);
        $query = Category::where('title',$data['category'])->first();
        $data['category_id'] = $query->id;
        if($request->hasfile('image'))
        {
        $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        else {
            $data['image'] = NULL;
        }
        $post = Post::create([
            'title'=>$data['title'],
            'category_id'=>$data['category_id'],
            'user_id'=>$data['user_id'],
            'description'=>$data['description'],
            'image'=>$data['image']
        ]);
        $postcount = count($post);
        event (new AddPostEvent($postcount));
        return redirect()->route('profile.index')->with(['message'=>'Added new post']);

    }
    public function show(Post $post)
    {
        $category = Category::select(
            'id',
            'title')
            ->paginate(4);
        $latest = Post::select(
            'id',
            'title',
            'created_at',
            'image')
            ->orderBy('id','desc')
            ->take(3)->get();
        return view ('users.posts.show')->with([
            'post' => $post,
            'category'=>$category,
            'latest'=>$latest,
        ]);
    }
    public function edit(Post $post)
    {
        $categories = Category::select(
            'id',
            'title')->get();
        return view ('users.posts.edit')->with([
            'post'=>$post,
            'categories'=>$categories,
        ]);
    }
    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->validated();
        if($request->hasfile('image')){
        $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        $post->update($data);
        $postcount = 0;
        event (new AddPostEvent($postcount));
        return redirect()->route('post.show',$post->id)->with(['message'=>'Updating post success']);

    }
    public function destroy(Post $post)
    {
        Comment::select('post_id')
            ->where('post_id',$post->id)
            ->delete();
        $deletepost = $post->delete();
        event (new DeletePostEvent($deletepost));
        return back()->with(['message' => 'Deleted Post Successfully']);
    }
}
