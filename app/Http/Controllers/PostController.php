<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view ('admin.posts.posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $posts = Post::all();
        return view ('admin.posts.addpost',compact('posts','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            // 'image' => 'image',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->description = $request->description;
        $post->save();
        // $post->image = $request->image;
        return redirect(route('post.index'))->with(['message'=>'Added new post']);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $category = Category::all();
        $posts = Post::find($post->id);
        $latest = Post::all()->sortByDesc('id');
        $find = Category::find($posts->category_id);
        // $num = Post::find('category_id', '6')->count();
        return view ('admin.posts.viewpost', compact('posts','category','find','latest','num'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        $posts = Post::find($post->id);
        $find = Category::find($posts->category_id);
        return view ('admin.posts.editpost', compact('posts','category','find'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::find($post->id)->delete();
        return redirect()->back()->with(['message' => 'Deleted Post Successfully']);

    }
}
