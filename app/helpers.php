<?php

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

function getRecentTags(){
    $user = Auth::user();

    return $user->userTag()->with('tag')->latest()->take(3)->get();
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

// function getMainTags(){

//     $all_tags = Tag::all();
//     $main_tags = [];

//     foreach($all_tags as $main_tag){
//         if($main_tag->isMain()){
//             $main_tags[] = $main_tag;
//         }
//     }
//     return array_slice($main_tags, 0, 3);
// }

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

// function getFavTags(){

//     $all_tags = Tag::all();
//     $fav_tags = [];

//     foreach($all_tags as $fav_tag){
//         if($fav_tag->isFav()){
//             $fav_tags[] = $fav_tag;
//         }
//     }
//     return $fav_tags;
// }

