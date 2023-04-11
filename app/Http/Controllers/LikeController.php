<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $chat_like;

    public function __construct(ChatLike $chat_like){
        $this->chat_like = $chat_like;
    }

    public function store($chat_id, Request $request){
        $this->chat_like->user_id = Auth::user()->id;
        $this->chat_like->chat_id = $chat_id;
        $this->chat_like->save();

        return redirect()->back();
    }

    public function destroy($chat_id){
        $this->chat_like
            ->where('user_id', Auth::user()->id)
            ->where('chat_id', $chat_id)
            ->delete();

            return redirect()->back();
    }
}
