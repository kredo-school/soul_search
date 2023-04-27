<?php

use Illuminate\Support\Facades\Auth;

function getRecentTags(){
    $user = Auth::user();

    $recent_tags = $user->userTag()
            ->with('tag')
            ->orderBy('last_access', 'desc')
            ->take(3)
            ->get();

    return $recent_tags;
}

function getMainTags(){
    $user = Auth::user();

    return $user->userTag()->where('tag_category', 'main')->with('tag')->get();
}

function getFavTags(){
    $user = Auth::user();

    return $user->userTag()->where('tag_category', 'favorite')->with('tag')->get();
}
