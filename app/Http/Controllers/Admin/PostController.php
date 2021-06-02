<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Comment;
use App\Category;
use App\Events\AddCategoryEvent;
use App\Events\AddPostEvent;
use App\Events\DeletePostEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'description',
            'created_at')->orderBy('id','desc')->paginate(5);
        return view ('admin.posts.posts')->with([
            'posts' => $posts
        ]);
    }
    public function realtimepost()
    {
        $posts = Post::select(
            'id',
            'title',
            'category_id',
            'user_id',
            'description',
            'created_at')->orderBy('id','desc')->paginate(5);
        return view ('admin.posts.realtimeposts')->with([
            'posts' => $posts
        ]);

    }
    public function create()
    {
        $categories = Category::select(
            'id',
            'title',
            'blogmax')
            ->get();
        return view ('admin.posts.addpost')->with([
            'categories'=>$categories
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);
        $query = Category::where('title',$data['category'])->first();
        $data['category_id'] = $query->id;
        if($request->hasfile('image')){
        $data['image'] = Storage::disk('public')
                            ->put('images',$data['image']);
        }
        else{
            $data['image']=NULL;
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
        $categorycount = 0;
        event (new AddCategoryEvent($categorycount));
        return redirect()->route('posts.index')->with(['message'=>'Added new post']);
    }
    public function show(Post $post)
    {
        $latest = Post::select(
            'id',
            'title',
            'image',
            'created_at')
            ->orderBy('id','desc')
            ->take(3)->get();
        $categories = Category::select('title')->take(3)->get();
        return view ('admin.posts.show')->with([
            'post' => $post,
            'latest' => $latest,
            'categories' => $categories,
        ]);
    }
    public function edit(Post $post)
    {
        return view ('admin.posts.editpost')->with([
            'post' => $post,
        ]);

    }
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);
        $query = Category::where('title',$data['category'])->first();
        $data['category_id'] = $query->id;
        if($request->hasfile('image')){
         $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        else{
            $data['image']=NULL;
        }
        $post->update([
            'title'=>$data['title'],
            'category_id'=>$data['category_id'],
            'user_id'=>$data['user_id'],
            'description'=>$data['description'],
            'image'=>$data['image']
        ]);
        $postcount = 0;
        event (new AddPostEvent($postcount));
        return redirect()->route('posts.index')->with(['message'=>'Post Updated Successfully']);

    }
    public function destroy(Post $post)
    {
        Comment::select('post_id')
            ->where('post_id',$post->id)
            ->delete();
        $deletepost = $post->delete();
        event (new DeletePostEvent($deletepost));
        return redirect()->route('posts.index')->with(['message' => 'Deleted Post Successfully']);
    }
}
