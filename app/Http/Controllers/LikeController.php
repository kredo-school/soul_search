<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;

    public function __construct(ChatLike $like){
        $this->like = $like;
    }

    public function store($chat_id, Request $request){
        $this->like->user_id = Auth::user()->id;
        $this->like->chat_id = $chat_id;
        $this->like->save();

        return redirect()->back();
    }

    public function destroy($chat_id){
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('chat_id', $chat_id)
            ->delete();

            return redirect()->view('home');
    }
}
