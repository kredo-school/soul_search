<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentLike;

class CommentLikeController extends Controller
{
    public function store(Post $post, Comment $comment, Request $request){
        $comment->likes()->attach([
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment){
        $comment->likes()->detach([
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
