<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like){
        $this->like = $like;
    }

    public function store($chat_id){
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

            return redirect()->back();
    }
}
