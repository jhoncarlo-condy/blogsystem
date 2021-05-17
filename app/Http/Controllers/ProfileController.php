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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'oldpassword' => ['required', new MatchOldPassword],
            'newpassword' => 'required',
            'confirmpassword' => 'same:newpassword',
        ]);

        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->newpassword)]);

        return redirect(route('profile'))->with(['message'=>'Password changed successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Post::where('user_id',$id)->count();
        $last = Post::where('user_id',$id)->latest('id')->get();
        $category = Category::all();
        $posts = Post::where('user_id',$id)->latest('id')->paginate(4);
        $commentcount = Comment::where('user_id',$id)->count();
        $users = User::find($id);
        return view('users.profile.visitprofile',compact('count','last','category','posts','commentcount','users'));
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
