<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }
    public function index()
    {
        $posts = Post::select('id','title','category_id',
            'user_id','description','created_at')->paginate(5);
        return view ('admin.posts.posts',[
            'posts' => $posts
        ]);
    }
    public function create()
    {
        $select = Category::select('id','title','blogmax');
        $categories = $select->where('blogmax','>', 0)->get();
        return view ('admin.posts.addpost',[
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
        if($request->hasfile('image'))
        {
        Storage::put('images', $data['image']);
        }
        Post::create($data);
        $category = Category::find($data['category_id']);
        $category->blogmax --;
        $category->update();
        // $post = new Post;
        // $post->title = $request->title;
        // $post->category_id = $request->category_id;
        // $post->user_id = $request->user_id;
        // $post->description = $request->description;
        // if ($request->hasFile('image'))
        // {
        //   $upload =  $request->image->store('images', 'public');
        //     $post->image = $upload;

        // }
        // $category = Category::find($request->category_id);
        // $category->blogmax = $category->blogmax+1;
        // $category->update();
        // $post->save();

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

        $latest = Post::select('id','title','image','created_at')->orderBy('id','desc')->get();
        $categories = Category::select('title')->get();
        $comments = $post->comments()->orderBy('id','desc')->get();
        return view ('admin.posts.show', [
            'post' => $post,
            'latest' => $latest,
            'categories' => $categories,
            'comments' => $comments

        ]);
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
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);


        if ($request->hasFile('image')) {


            $upload =  $request->image->store('images', 'public');
            $post = Post::find($post->id);
            $category = Category::where('id',$post->category->id)->first();
            $req = Category::where('id',$request->category_id)->first();
            if ($post->category->id != $request->category_id) {
                $category->blogmax = $category->blogmax-1;
                $req->blogmax = $req->blogmax+1;
                $category->update();
                $req->update();
            }
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->user_id = $request->user_id;
            $post->description = $request->description;
            $post->image = $upload;
            $post->update();

        }
        else {


            $post = Post::find($post->id);
            $category = Category::where('id',$post->category->id)->first();
            $req = Category::where('id',$request->category_id)->first();
            if ($post->category->id != $request->category_id) {
                $category->blogmax = $category->blogmax-1;
                $req->blogmax = $req->blogmax+1;
                $category->update();
                $req->update();
            }
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->user_id = $request->user_id;
            $post->description = $request->description;
            $post->update();
        }




        return redirect(route('post.index'))->with(['message'=>'Updating post success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        $category = Category::where('id',$post->category->id)->first();
        $category->blogmax = $category->blogmax-1;
        $category->update();
        $post->delete();
        return redirect(route('post.index'))->with(['message' => 'Deleted Post Successfully']);

    }
}
