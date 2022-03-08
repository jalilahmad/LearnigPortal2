<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\CourseEpisode;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->comment_text = $request->get('comment_text');
        $comment->user()->associate($request->user());
        $episode = CourseEpisode::find($request->get('episode_id'));
        $episode->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->comment_text = $request->get('comment_text');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $episode = CourseEpisode::find($request->get('episode_id'));

        $episode->comments()->save($reply);

        return back();

    }
}
