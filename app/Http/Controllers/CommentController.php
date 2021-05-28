<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Category;
use App\Events\AddCommentEvent;
use Illuminate\Http\Request;
use App\Events\AddCountEvent;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required',
            'user_id'=>'required',
            'post_id'=>'required',
        ]);

        $comment = Comment::create($data);
        $commentcount = count($comment);
        event (new AddCommentEvent($commentcount));
        return back()->with(['message','Your comment has been added']);
    }
    public function show(Post $postcomments)
    {
        return view ('users.posts.allcomments')->with([
            'postcomments'=>$postcomments
        ]);
    }
}
