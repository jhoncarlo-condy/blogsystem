<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $count = Post::where('user_id',Auth::user()->id)->count();
        $last = Post::where('user_id',Auth::user()->id)->latest('id')->get();
        $category = Category::all();
        $posts = Post::where('user_id', Auth::user()->id)->latest('id')->paginate(3);
        $commentcount = Comment::where('user_id',Auth::user()->id)->count();
        return view ('users.profile.view', compact('posts','category','count','last','commentcount'));
    }
       public function store(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', new MatchOldPassword],
            'newpassword' => 'required',
            'confirmpassword' => 'same:newpassword',
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->newpassword)]);

        return redirect(route('profile'))->with(['message'=>'Password changed successfully']);
    }
    public function show(User $profile)
    {
        $query = Post::select('id','title','category_id','user_id','description','created_at');
        // $category = Category::all();
        $posts = $query->where('user_id',$profile)->latest('id')->paginate(3);

        return view('users.profile.visitprofile',with([
            'profile'=>$profile,
            'posts'=>$posts
        ]));
    }
}
