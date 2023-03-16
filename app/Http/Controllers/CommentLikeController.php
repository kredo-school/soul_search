<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function store(Post $post, Comment $comment, Request $request){
        $comment->likes()->attach([
            'user_id' => Auth::id()
        ]);
        // if(CommentLike::onlyTrashed()->where('user_id', Auth::id())->where('comment_id', $request->comment_id)->exists()){
        //     CommentLike::onlyTrashed()->where('user_id', Auth::id())->where('comment_id', $request->comment_id)->restore();
        // }else{
        //     CommentLike::create([
        //         'comment_id' => $request->comment_id,
        //         'user_id' => Auth::id(),
        //     ]);
        // }

        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment){
        $comment->likes()->detach(['user_id' => Auth::id()]);
        // CommentLike::where('user_id', Auth::id())->where('comment_id', $id)->delete();

        return redirect()->back();
    }
}
