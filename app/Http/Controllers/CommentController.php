<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
      #Validate the request
      $request->validate([
          'comment' => 'required',
      ]);

    Comment::create([
        'post_id'  => $post->id,
        'user_id'  => Auth::id(),
        'comment'  => $request->comment,
    ]);

      return redirect()->back();
    }

    public function destroy(Post $post, Comment $comment)
    {
        $post->comments()->where('id', $comment->id)->delete();

        return redirect()->back();
    }
}
