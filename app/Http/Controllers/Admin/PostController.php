<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return redirect(route('posts.index'))->with(['message'=>'Added new post']);



    }

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

    public function edit(Post $post)
    {
        $query = Category::select('id','title','blogmax');
        $categories= $query->where('blogmax','>',0)->get();
        return view ('admin.posts.editpost', [
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


        $newcategory = Category::select('id')->where('id',$data['category_id'])->first();
        if($post->category->id != $request->category_id)
        {
            $post->category->blogmax = $post->category->blogmax+1;
            $newcategory->blogmax = $newcategory->blogmax-1;
            $post->update($data);
            $newcategory->update();
        }
        else {
            $post->update($data);
        }

        // if ($request->hasFile('image')) {


        //     $upload =  $request->image->store('images', 'public');
        //     $post = Post::find($post->id);
        //     $category = Category::where('id',$post->category->id)->first();
        //     $req = Category::where('id',$request->category_id)->first();
        //     if ($post->category->id != $request->category_id) {
        //         $category->blogmax = $category->blogmax-1;
        //         $req->blogmax = $req->blogmax+1;
        //         $category->update();
        //         $req->update();
        //     }
        //     $post->title = $request->title;
        //     $post->category_id = $request->category_id;
        //     $post->user_id = $request->user_id;
        //     $post->description = $request->description;
        //     $post->image = $upload;
        //     $post->update();

        // }
        // else {


        //     $post = Post::find($post->id);
        //     $category = Category::where('id',$post->category->id)->first();
        //     $req = Category::where('id',$request->category_id)->first();
        //     if ($post->category->id != $request->category_id) {
        //         $category->blogmax = $category->blogmax-1;
        //         $req->blogmax = $req->blogmax+1;
        //         $category->update();
        //         $req->update();
        //     }
        //     $post->title = $request->title;
        //     $post->category_id = $request->category_id;
        //     $post->user_id = $request->user_id;
        //     $post->description = $request->description;
        //     $post->update();
        // }




        return redirect(route('posts.index'))->with(['message'=>'Updating post success']);
    }

    public function destroy(Post $post)
    {
        $category = $post->category;
        $category->blogmax++;
        $category->update();
        $post->delete();
        return redirect(route('posts.index'))->with(['message' => 'Deleted Post Successfully']);

    }
}