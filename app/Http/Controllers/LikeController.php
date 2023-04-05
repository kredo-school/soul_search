<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Chat $chat, Request $request){
        $chat->likes()->attach([
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy(Chat $chat){
        $chat->likes()->detach([
            'user_id' => Auth::id(),
        ]);
            return redirect()->back();
    }
}
