<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Comment;
use App\Category;

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
            'created_at')->paginate(5);
        return view ('admin.posts.posts')->with([
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
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if($request->hasfile('image')){
        $data['image'] = Storage::disk('public')
                            ->put('images',$data['image']);
        }
        Post::create($data);
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
    public function update(StorePostRequest $request, Post $post)
    {
        $data = $request->validated();
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
        $post->delete();
        return redirect()->route('posts.index')->with(['message' => 'Deleted Post Successfully']);
    }
}
