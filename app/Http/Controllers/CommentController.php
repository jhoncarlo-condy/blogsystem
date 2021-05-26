<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Category;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required',
            'user_id'=>'required',
            'post_id'=>'required',
        ]);

        Comment::create($data);
        return back()->with(['message','Your comment has been added']);
    }
    public function show(Post $postcomments)
    {
        return view ('users.posts.allcomments')->with([
            'postcomments'=>$postcomments
        ]);
    }
}
