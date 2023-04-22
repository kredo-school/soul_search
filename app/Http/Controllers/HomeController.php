<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Tag $tag){

        // Need to update to show only tagged chats a user wants
        // Need to show main tags(max:3) and added tags
        $tagged_chats = [];
        $recent_tags = getRecentTags();
        $main_tags = getMainTags();
        $fav_tags = getFavTags();
        $close_users = $this->showCloseUsers();

        // Need to fix to reflect the update of migrations
        foreach($tagged_chats as $chat){
            if($chat->main_tag->isMain() || $chat->fav_tag->isFav() || $chat->recent_tag->isRecent()){
                $tagged_chats[] = $chat;
            }
        }

        return view('home')
            ->with('tag', $tag)
            ->with('close_users', $close_users)
            ->with('tagged_chats', $tagged_chats)
            ->with('recent_tags', $recent_tags)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags);
    }

    public function showCloseUsers()
    {
        $all_users = User::latest()->get();
        $close_users = [];

        $user = Auth::user();

        $pivot_items = collect($user->messagesSent)->merge($user->messagesReceived)->sortBy('pivot.created_at')
        ->filter(function($a) use($user){
            return $a->pivot->sender_id == $user->id || $a->pivot->receiver_id == $user->id;
        });

        foreach($all_users as $user){
            if($user->id !== Auth::user()->id){
                $close_users[] = $user;
            }
        }

        // return view('home', compact('user', 'all_users', 'pivot_items'));
        return array_slice($close_users, 0, 8);
    }
}
