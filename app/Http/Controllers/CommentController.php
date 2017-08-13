<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addThreadComment(Request $request, Thread $thread){
        $this->validate($request,[
            'body'=>'required'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;

        $thread->comments()->save($comment);

        return back()->withMessage('Comment Created');
}


    public function addReplyComment(Request $request, Comment $comment){
        $this->validate($request,[
            'body'=>'required'
        ]);

        $reply = new Comment();
        $reply->body = $request->body;
        $reply->user_id = Auth::user()->id;

        $comment->comments()->save($reply);

        return back()->withMessage('Reply Created');
    }







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //

        if($comment->user_id !== Auth::user()->id)
            abort('401');

        $this->validate($request,[
            'body'=>'required'
        ]);

        $comment->update($request->all());

        return back()->withMessage('Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id !== Auth::user()->id)
            abort('401');
        $comment->delete();

        return back()->withMessage('Deleted');
    }
}
