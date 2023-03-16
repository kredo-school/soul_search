<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostLike;

class PostLikeController extends Controller
{
    public function store(Request $request){
        PostLike::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        PostLike::where('user_id', Auth::id())
                ->where('post_id', $id)
                ->delete();

        return redirect()->back();
    }
}
