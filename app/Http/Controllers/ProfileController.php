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
        $query = Post::select('id','title','category_id','user_id','description','image','created_at')
                        ->where('user_id', Auth::user()->id)->latest('id');
        $posts = $query->paginate(2);
        $categories = Category::select('id','title')->get();
        return view ('users.profile.index', with([
            'categories'=>$categories,
            'posts'=>$posts,
        ]));
    }
       public function store(Request $request)
    {
        $data = $request->validate([
            'oldpassword' => ['required', new MatchOldPassword],
            'newpassword' => 'required',
            'confirmpassword' => 'same:newpassword',
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($data['password'])]);

        return redirect(route('profile'))->with(['message'=>'Password changed successfully']);
    }
    public function show(User $profile)
    {
        $posts = $profile->post()->orderBy('id','desc')->paginate(2);
        return view('users.profile.visitprofile',with([
            'profile'=>$profile,
            'posts'=>$posts
        ]));
    }
}
