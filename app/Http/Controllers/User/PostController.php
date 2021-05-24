<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Category;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

    public function index()
    {
        $query = Post::select('id','category_id','user_id','description','image','created_at');
        $posts = $query->orderBy('id','desc')->paginate(6);
        $latest = $query->orderBy('id','desc')->take(3)->get();
        if(Auth::user())
        {
        $myrecent = $query->where('user_id', Auth::user()->id)
                        ->orderBy('created_at','desc')->get();
        }
        $categories = Category::select('id','title')->paginate(4);
        return view('users.home.content',with([
            'posts'=>$posts,
            'latest'=>$latest,
            'myrecent'=>$myrecent,
            'categories'=>$categories,
        ]));
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
    public function show(Post $post)
    {
        $category = Category::paginate(4);
        $latest = Post::all()->sortByDesc('id');
        $comments = Comment::all()->where('post_id',$post)->sortByDesc('id');
        $commentcount = Comment::all()->where('post_id',$post)->count();
        $count = Post::all();


        // $find = Category::find($posts);
        return view ('users.view.view',with([
            'post' => $post,
            'category'=>$category,
            'latest'=>$latest,
            'comments'=>$comments,
            'commentcount'=>$commentcount,
            'count'=>$count
        ]));
    }

    public function category()
    {
        $lists = Category::paginate(4);
        $categories = Category::with(['posts' => function($query) {
            $query->latest();
        }])->paginate(4);
        $count = Post::all();

        return view ('users.categories.category',compact('categories','lists','count'));
    }

    public function viewcat($id)
    {
        $lists = Category::all();
        $categories = Category::find($id);
        $posts = Post::where('category_id',$id)->orderBy('id','desc')->paginate(4);
        $count = Post::all();
        return view ('users.categories.view',compact('posts','lists','count','categories'));
    }

    public function profile()
    {
        $count = Post::where('user_id',Auth::user()->id)->count();
        $last = Post::where('user_id',Auth::user()->id)->latest('id')->get();
        $category = Category::all();
        $posts = Post::where('user_id', Auth::user()->id)->latest('id')->paginate(3);
        $commentcount = Comment::where('user_id',Auth::user()->id)->count();
        return view ('users.profile.view', compact('posts','category','count','last','commentcount'));
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
        return view ('users.editpost.index', with([
            'category'=>$category,
            'posts'=>$posts,
            'find'=>$find
        ]));
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
