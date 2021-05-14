<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $content = Post::orderBy('id','desc')->paginate(6);
        $latest = Post::all()->sortByDesc('id');
        $categories = Category::all();
        return view('users.home.content',compact('latest','content','categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'image' => 'file|image|max:5000',
        ]);


        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->description = $request->description;
        if ($request->hasFile('image'))
        {
          $upload =  $request->image->store('images', 'public');
            $post->image = $upload;

        }
        $post->save();

        // $post->image = $request->image;
        return redirect()->back()->with(['message'=>'Added new post']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        $category = Category::all();
        $latest = Post::all()->sortByDesc('id');
        // $find = Category::find($posts);
        return view ('users.view.view',compact('posts','latest','category'));
    }

    public function viewcat()
    {
        $categories = Category::all();
        $posts = Post::all()->sortByDesc('category_id');
        return view ('users.categories.view',compact('categories','posts'));
    }

    public function profile()
    {
        $category = Category::all();
        $posts = Post::where('user_id', Auth::user()->id)->latest('id')->get();
        return view ('users.profile.view', compact('posts','category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
