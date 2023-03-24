<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->latest()->get();

        $messages_sent     = Message::where('sender_id', Auth::id())->latest()->get();
        $messages_received = Message::where('receiver_id', Auth::id())->latest()->get();
        $friend_ids = [];
        foreach($messages_sent as $message){
            $friend_ids[] = $message->receiver_id;
        }
        foreach($messages_received as $message){
            $friend_ids[] = $message->sender_id;
        }
        $collection = collect($friend_ids);
        $friend_ids = $collection->unique();

        return view('users.messages.index', compact('messages', 'friend_ids'));
    }
}
