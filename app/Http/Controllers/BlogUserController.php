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
        $myrecent = Post::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        $categories = Category::all();
        return view('users.home.content',compact('latest','content','categories','myrecent'));
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

    public function category()
    {
        $lists = Category::all();
        $categories = Category::with(['posts' => function($query) {
            $query->latest();
        }])->get();

        return view ('users.categories.view',compact('categories','lists'));
    }

    public function viewcat($id)
    {
        $lists = Category::all();
        $posts = Post::where('category_id',$id)->orderBy('id','desc')->paginate(4);

        return view ('users.categories.category',compact('posts','lists'));
    }

    public function profile()
    {
        $count = Post::where('user_id',Auth::user()->id)->count();
        $last = Post::where('user_id',Auth::user()->id)->latest('id')->get();
        $category = Category::all();
        $posts = Post::where('user_id', Auth::user()->id)->latest('id')->paginate(4);
        return view ('users.profile.view', compact('posts','category','count','last'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $posts = Post::find($id);
        $find = Category::find($posts->category_id);
        return view ('users.editpost.index', compact('posts','category','find'));
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
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
            'image' => 'file|image|max:5000',
        ]);


        if ($request->hasFile('image')) {


            $upload =  $request->image->store('images', 'public');
            $post = Post::find($id);
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->user_id = $request->user_id;
            $post->description = $request->description;
            $post->image = $upload;
            $post->update();

        }
        else {

            $post = Post::find($id);
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->user_id = $request->user_id;
            $post->description = $request->description;
            $post->update();
        }




        return redirect(route('blog.show',$post->id))->with(['message'=>'Updating post success']);

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
