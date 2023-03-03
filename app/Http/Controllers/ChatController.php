<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $chat;
    private $tag;

    public function __construct(Chat $chat, Tag $tag){
        $this->chat = $chat;
        $this->tag  = $tag;
    }

    public function store($tag_id, Request $request){
        $request->validate([
            'chat' =>'required|min:1|max:255',
            'image' => 'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        #Save the chat
        $this->chat->user_id = Auth::user()->id;
        $this->chat->tag_id = $request->tag;
        $this->chat->chat = $request->chat;
        $this->chat->image = $this->saveImage($request);
        $this->chat->save();

        return redirect()->route('index');

    }
}
