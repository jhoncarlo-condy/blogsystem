<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Comment;
use App\Category;

use App\Events\AddPostEvent;
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
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);
        if($request->hasfile('image')){
        $data['image'] = Storage::disk('public')
                            ->put('images',$data['image']);
        }
        $post = Post::create($data);
        $postcount = count($post);
        event (new AddPostEvent($postcount));
        return redirect(route('posts.index'))->with(['message'=>'Added new post']);
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
        $categories = Category::select(
            'id',
            'title',
            'blogmax')
            ->get();
        return view ('admin.posts.editpost')->with([
            'post' => $post,
            'categories'=>$categories
        ]);

    }
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);
        if($request->hasfile('image')){
         $data['image'] = Storage::disk('public')->put('images',$data['image']);
        }
        $post->update($data);
        return redirect()->route('posts.index')->with(['message'=>'Post Updated Successfully']);

    }
    public function destroy(Post $post)
    {
        Comment::select('post_id')
            ->where('post_id',$post->id)
            ->delete();
        $deletepost = $post->delete();
        event (new AddPostEvent($deletepost));
        return redirect()->route('posts.index')->with(['message' => 'Deleted Post Successfully']);
    }
}
