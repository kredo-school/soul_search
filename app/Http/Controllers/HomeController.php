<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    private $chat;
    private $user;
    private $tag;
    private $user_tag;

    public function __construct(Chat $chat, User $user, Tag $tag, UserTag $user_tag)
    {
        $this->chat = $chat;
        $this->user = $user;
        $this->tag = $tag;
        $this->user_tag = $user_tag;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $all_chats = $this->chat->latest()->get();

        // Need to update to show only tagged chats a user wants
        // Need to show main tags(max:3) and added tags
        $tagged_chats = [];
        $recent_tags = $this->getRecentTags();
        $main_tags = $this->getMainTags();
        $fav_tags = $this->getFavTags();

        // Need to fix to reflect the update of migrations
        foreach($tagged_chats as $chat){
            if($chat->tag->isMain() || $chat->tag->isFav()){
                $tagged_chats[] = $chat;
            }
        }

        return view('home')
            ->with('tagged_chats', $tagged_chats)
            ->with('recent_tags', $recent_tags)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags);
    }

    private function getRecentTags(){
        $all_tags = $this->tag->all();
        dd($this->user->userTag);
        $recent_tags = $this->user_tag->latest()->get();

        return array_slice($recent_tags, 0, 3);
    }

    private function getMainTags(){

        $all_tags = $this->tag->all();
        $main_tags = [];

        foreach($all_tags as $tag){
            if($tag->isMain()){
                $main_tags[] = $tag;
            }
        }

        return array_slice($main_tags, 0, 3);
    }

    private function getFavTags(){

        $all_tags = $this->tag->all();
        $fav_tags = [];

        foreach($all_tags as $tag){
            if($tag->isFav()){
                $fav_tags[] = $tag;
            }
        }

        return array_slice($fav_tags, 0, 10);
    }
}
