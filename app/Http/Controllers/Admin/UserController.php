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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');


    }
    public function index()
    {
        $select = User::select('id','firstname','lastname','email','usertype');
        $users = $select->paginate(5);
        return view ('admin.users', [
            'users'=> $users
        ]);
    }
    public function dashboard()
    {

        $countusers = User::count('usertype',3);
        $countcat = Category::count();
        $countpost = Post::count();
        $commentcount = Comment::count();
        return view ('admin.dashboard', [
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

        User::create($data);
        return redirect()->back()->with(['message'=>'User Added Successfully']);


    }
    public function show(User $user)
    {
        $posts = Post::select('title','category','user_id','description','image','created_at');


        $count = $posts->count('user_id',$user);
        $last = $user->posts()->latest('id')->first();
        $posts = $user->posts()->latest('id')->paginate(2);
        $commentcount = $user->comments()->count();

        return view('admin.visitprofile',[
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
        return redirect()->back()->with(['message'=>'User Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['message' => 'User Deleted Successfully']);
    }
}
