<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $chat_like;

    public function store(Chat $chat){
        $chat->likes()->attach(Auth::id());

        return redirect()->back();
    }

    public function destroy(Chat $chat){
        $chat->likes()->detach(Auth::id());

        return redirect()->back();
    }
}
