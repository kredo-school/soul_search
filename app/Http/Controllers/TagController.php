<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function edit($id)
    {
        $user           = Auth::user();
        $main_tags      = getMainTags(); // from helpers
        $fav_tags       = getFavTags(); // from helpers

        return view('users.profiles.tags.edit', compact('user', 'main_tags', 'fav_tags'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9]+$/|max:255'
        ]);
        $tag_name = $request->name;
        $category = $request->category;

        $db_tags = Tag::get();
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->name == $tag_name){
                $is_new = false;
                // create UserTag
                UserTag::create([
                    'user_id'      => Auth::id(),
                    'tag_id'       => $db_tag->id,
                    'tag_category' => $category,
                ]);
            }
        }
        if($is_new){
            // create new Tag
            $new_tag = new Tag;
            $new_tag->name = $tag_name;
            $new_tag->save();

            $new_tag_id = $new_tag->id;

            // create UserTag
            UserTag::create([
                'user_id'      => Auth::id(),
                'tag_id'       => $new_tag_id,
                'tag_category' => $category,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Request $request){
        // delete UserTag
        foreach($request->usertag_ids as $id){
            UserTag::where('id', $id)->delete();
        }
        return redirect()->back();
    }
}
