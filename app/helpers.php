<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

function getRecentTags(){
    $user = Auth::user();

    // return $user->userTag()->with('tag')->latest()->take(3)->get();
    $recent_tags = $user->userTag()
            ->with('tag')
            ->orderBy('last_access', 'desc')
            ->take(3)
            ->get();

    foreach ($recent_tags as $recent_tag) {
        $recent_tag->updateLastAccess();
    }

    return $recent_tags;
}

function getMainTags(){
    $user = Auth::user();
    $all_tags = Tag::all();
    $main_tags = [];

    foreach($all_tags as $main_tag){
        if($main_tag->isMain()){
            $main_tags[] = $main_tag;
        }
    }
    return $user->userTag()->where('tag_category', config('enums')['tag_category']['main'])->with('tag')->take(3)->get();
}

function getFavTags(){
    $user = Auth::user();
    $all_tags = Tag::all();
    $fav_tags = [];

    foreach($all_tags as $fav_tag){
        if($fav_tag->isFav()){
            $fav_tags[] = $fav_tag;
        }
    }
    return $user->userTag()->where('tag_category', config('enums')['tag_category']['favorite'])->with('tag')->get();
}
