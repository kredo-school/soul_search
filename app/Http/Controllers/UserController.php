<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $main_tags = getMainTags(); // from helpers
        return view('users.profiles.show', compact('user', 'main_tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $main_tags = getMainTags(); // from helpers

        return view('users.profiles.show', compact('user', 'main_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user           = Auth::user();
        $main_tags      = getMainTags(); // from helpers
        $fav_tags       = getFavTags(); // from helpers

        return view('users.profiles.edit', compact('user', 'main_tags', 'fav_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'username'     => 'required|max:100',
            'email'        => 'required|max:100|email',
            'introduction' => 'max:10000|nullable',
            'm_tag_str'    => 'string',
            'f_tag_str'    => 'string|nullable',
        ]);

        $user->username     = $request->username;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;
        $user->save();


        // Tag and UserTag update
        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        $m_count       = 0;
        $m_category    = 'main';
        $f_count       = 0;
        $f_category    = 'favorite';

        $new_tag_id = $this->updateTag($new_tag_id, $m_count, $m_category, $request->old_m_tag_count, $request->old_m_tag_ids, $request->m_tag_str);
        $new_tag_id = $this->updateTag($new_tag_id, $f_count, $f_category, $request->old_f_tag_count, $request->old_f_tag_ids, $request->f_tag_str);

        return redirect()->route('profiles.index');
    }

    private function updateTag($new_tag_id, $count, $category, $old_tag_count, $old_tag_ids, $new_tag_str){
        preg_match_all("/#(\\w+)/", $new_tag_str, $hashtags);
        foreach($hashtags[1] as $tag_name){
            if($count < $old_tag_count){
                // both old and new exist, update if old tag != new tag
                if(Tag::where('id', $old_tag_ids[$count])->first()->name !== $tag_name){
                $this->deleteTag($old_tag_ids[$count]);
                $new_tag_id = $this->storeTag($tag_name, $new_tag_id, $category);
                }
            }else{
                // only new exists
                $new_tag_id = $this->storeTag($tag_name, $new_tag_id, $category);
            }
            $count++;
        }
        for($i = $count; $i < $old_tag_count; $i++){
            // only old exists
            $this->deleteTag($old_tag_ids[$count]);
        }
        return $new_tag_id;
    }

    private function storeTag($tag_name, $new_tag_id, $category){
        $db_tags = Tag::get();
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->name === $tag_name){
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
            Tag::create([
                'name' => $tag_name,
            ]);

            // create UserTag
            UserTag::create([
                'user_id'      => Auth::id(),
                'tag_id'       => $new_tag_id,
                'tag_category' => $category,
            ]);
            $new_tag_id++;
        }

        return $new_tag_id;
    }

    private function deleteTag($old_tag_id){
        // delete old UserTag
        UserTag::where('tag_id', $old_tag_id)->where('user_id', Auth::id())->limit(1)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
