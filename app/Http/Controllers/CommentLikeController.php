<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;
=======
>>>>>>> origin/demo/for-taka-san

class CommentLikeController extends Controller
{
    public function store(Post $post, Comment $comment, Request $request){
        $comment->likes()->attach([
<<<<<<< HEAD
            'user_id' => Auth::id(),
        ]);
=======
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
>>>>>>> origin/demo/for-taka-san

        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment){
<<<<<<< HEAD
        $comment->likes()->detach([
            'user_id' => Auth::id(),
        ]);
=======
        $comment->likes()->detach(['user_id' => Auth::id()]);
        // CommentLike::where('user_id', Auth::id())->where('comment_id', $id)->delete();
>>>>>>> origin/demo/for-taka-san

        return redirect()->back();
    }
}
