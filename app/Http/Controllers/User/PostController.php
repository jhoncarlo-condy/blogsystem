<?php

namespace App\Http\Controllers\User;
use App\Post;
use App\User;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{

    public function index()
    {
        $query = Post::select('id','title','category_id','user_id','image','created_at');
        $posts = $query->orderBy('id','desc')->paginate(6);
        $latest = $query->orderBy('id','desc')->take(3)->get();
        if (Auth::user()) {
            $myrecent = $query->where('user_id', Auth::user()->id)
                        ->orderBy('created_at','desc')->get();
        }
        else {
            $myrecent = '';
        }
        $categories = Category::select('id','title')->take(4)->get();
        return view('users.posts.index',with([
            'posts'=>$posts,
            'latest'=>$latest,
            'myrecent'=>$myrecent,
            'categories'=>$categories,
        ]));
    }
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if($request->hasfile('image'))
        {
        $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        Post::create($data);
        $category = Category::find($data['category_id']);
        $category->blogmax --;
        $category->update();
        return redirect()->back()->with(['message'=>'Added new post']);

    }
    public function show(Post $post)
    {
        $category = Category::select('id','title')->paginate(4);
        $latest = Post::select('id','title','created_at','image')
                    ->orderBy('id','desc')->take(3)->get();


        // $find = Category::find($posts);
        return view ('users.posts.show',with([
            'post' => $post,
            'category'=>$category,
            'latest'=>$latest,
        ]));
    }
    public function edit(Post $post)
    {
        $categories = Category::select('id','title');
        return view ('users.posts.edit', with([
            'post'=>$post,
            'categories'=>$categories,
        ]));
    }
    public function update(StorePostRequest $request, Post $post)
    {

        $data = $request->validated();
        $category = Category::select('id','blogmax');
        $newcategory = $category->where('id',$data['category_id'])->first();

        if($request->hasfile('image'))
        {
        $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        if($post->category->id != $data['category_id'])
        {

            $newcategory->blogmax--;
            $oldcategory = $post->category;
            $oldcategory->blogmax++;
            $oldcategory->update();
            $newcategory->update();
            $post->update($data);
        return redirect(route('post.show',$post->id))->with(['message'=>'Updating post success']);

        }
        else {
            $post->update($data);
        return redirect(route('post.show',$post->id))->with(['message'=>'Updating post success']);
        }

    }
}
