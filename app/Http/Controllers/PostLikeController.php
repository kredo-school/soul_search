<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function store(Post $post, Request $request){
        $post->likes()->attach([
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy(Post $post){
        $post->likes()->detach([
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
