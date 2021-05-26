<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $select = User::select(
            'id',
            'firstname',
            'lastname',
            'email',
            'usertype');
        $users = $select->paginate(5);
        return view ('admin.users')->with([
            'users'=> $users
        ]);
    }
    public function dashboard()
    {
        $countusers = User::count('usertype',3);
        $countcat = Category::count();
        $countpost = Post::count();
        $commentcount = Comment::count();
        return view ('admin.dashboard')->with([
            'countusers' => $countusers,
            'countcat' => $countcat,
            'countpost' => $countpost,
            'commentcount' => $commentcount,
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'usertype' => 'required'
        ]);
        $data['password']= Hash::make($data['password']);
        User::create($data);
        return back()->with(['message'=>'User Added Successfully']);


    }
    public function show(User $user)
    {
        $posts = Post::select(
            'title',
            'category',
            'user_id',
            'description',
            'image',
            'created_at');
        $count = $posts->count('user_id',$user);
        $last = $user->posts()->latest('id')->first();
        $posts = $user->posts()->latest('id')->paginate(2);
        $commentcount = $user->comments()->count();
        return view('admin.visitprofile')->with([
            'user'=>$user,
            'count'=>$count,
            'last' => $last,
            'posts'=> $posts,
            'commentcount' => $commentcount,
        ]);
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'usertype' => 'required'
        ]);

        $user->update($data);
        return back()->with(['message'=>'User Updated Successfully']);

    }
    public function destroy(User $user)
    {
        Post::select('user_id')
            ->where('user_id',$user->id)
            ->delete();
        Comment::select('user_id')
            ->where('user_id',$user->id)
            ->delete();
        $user->delete();
        return back()->with(['message' => 'User Deleted Successfully']);
    }


}
