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

        // Need to fix to reflect the update of migrations
        foreach($tagged_chats as $chat){
            if($chat->main_tag->isMain() || $chat->fav_tag->isFav() || $chat->recent_tag->isRecent()){
                $tagged_chats[] = $chat;
            }
        }

        return view('home')
            ->with('tag', $tag)
            ->with('tagged_chats', $tagged_chats)
            ->with('recent_tags', $recent_tags)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags);
    }

    public function showCloseUsers(User $user)
    {
        $all_users = User::latest()->get();

        $authUser = Auth::user();

        $pivot_items = collect($authUser->messagesSent)->merge($authUser->messagesReceived)->sortBy('pivot.created_at')
        ->filter(function($a) use($user){
            return $a->pivot->sender_id == $user->id || $a->pivot->receiver_id == $user->id;
        });

        return view('home', compact('user', 'all_users', 'pivot_items'));
    }

}
