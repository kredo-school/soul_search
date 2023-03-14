<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use App\Models\Tag;

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

    public function __construct(Chat $chat, User $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // For Guests
    public function index(){
        $all_chats = $this->chat->latest()->get();

        return view('home');
    }

    // For Registered Users
    public function home(){
        $all_chats = $this->chat->latest()->get();

        // Need to update to show only tagged chats a user wants
        // Need to show main tags(max:3) and added tags
        $tagged_chats = [];
        $recent_tags = $this->getRecentTags();
        $main_tags = $this->getMainTags();
        $fav_tags = $this->getFavTags();

        foreach($all_chats as $chat){
            if($chat->tag->isMain() || $chat->tag->isFav() || $chat->tag->isRecent()){
                $tagged_chats[] = $chat;
            }
        }

        return view('home')
            ->with('tagged_chats', $tagged_chats)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags)
            ->with('recent_tags', $recent_tags);
    }

    private function getRecentTags(){
        return []; // To be removed

        $all_tags = $this->tag->all();
        $recent_tags = [];

        foreach($all_tags as $tag){
            if($tag->isRecent()){
                $recent_tags[] = $tag;
            }

            return array_slice($recent_tags, 0, 3);
        }
    }

    private function getMainTags(){
        return []; // To be removed

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
        return []; // To be removed

        $all_tags = $this->tag->all();
        $fav_tags = [];

        foreach($all_tags as $tag){
            if($tag->isFav()){
                $fav_tags[] = $tag;
            }

            return array($fav_tags);
        }
    }



    public function showUser($id){
        $user = $this->user->findOrFail($id);

        return view('home');
    }
}
