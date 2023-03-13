<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommentLike;

class CommentLikeController extends Controller
{
    public function store(Request $request){
        CommentLike::create([
            'comment_id' => $request->comment_id,
            'user_id'    => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        CommentLike::where('user_id', Auth::id())->where('comment_id', $id)->delete();

        return redirect()->back();
    }
}
