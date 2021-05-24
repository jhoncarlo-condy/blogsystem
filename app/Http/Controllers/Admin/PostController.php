<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::select('id','title','category_id',
            'user_id','description','created_at')->paginate(5);
        return view ('admin.posts.posts',with([
            'posts' => $posts
        ]));
    }
    public function create()
    {
        $categories = Category::select('id','title','blogmax')
                        ->where('blogmax','>', 0)->get();
        return view ('admin.posts.addpost',with([
            'categories'=>$categories
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
        return redirect(route('posts.index'))->with(['message'=>'Added new post']);
    }
    public function show(Post $post)
    {

        $latest = Post::select('id','title','image','created_at')
                    ->orderBy('id','desc')
                    ->take(3)->get();
        $categories = Category::select('title')->take(7)->get();
        return view ('admin.posts.show', with([
            'post' => $post,
            'latest' => $latest,
            'categories' => $categories,
        ]));
    }
    public function edit(Post $post)
    {
        $categories = Category::select('id','title','blogmax')
                        ->where('blogmax','>',0)->get();
        return view ('admin.posts.editpost',with([
            'post' => $post,
            'categories'=>$categories
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
        return redirect(route('posts.index'))->with(['message'=>'Updating post success']);

        }
        else {
            $post->update($data);
        return redirect(route('posts.index'))->with(['message'=>'Error']);
        }
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
