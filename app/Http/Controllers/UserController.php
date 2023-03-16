<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $user_tags = UserTag::where('user_id', Auth::id())->get();
        $tags      = [];
        foreach($user_tags as $user_tag){
            $tags[] = Tag::find($user_tag->tag_id);
        }
        return view('users.profiles.index', compact('user', 'tags'));
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
        $user = User::find($id);

        $user_tags = UserTag::where('user_id', $id)->get();
        $tags      = [];
        foreach($user_tags as $user_tag){
            $tags[] = Tag::find($user_tag->tag_id);
        }

        return view('users.profiles.show', compact('user', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user      = User::find(Auth::id());
        $user_tags = UserTag::where('user_id', Auth::id())->get();
        $tags      = [];
        $tag_count = 0;
        foreach($user_tags as $user_tag){
            $tags[] = Tag::find($user_tag->tag_id);
            $tag_count++;
        }

        return view('users.profiles.edit', compact('user', 'tags', 'tag_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'         => 'min:1|max:100',
            'email'        => 'min:1|max:100|email',
            'tags'         => 'max:100',
            'introduction' => 'max:10000',
        ]);

        User::where('id', Auth::id())
            ->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'introduction' => $request->introduction,
        ]);

        // Tag and UserTag update
        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        $count         = 0;
        foreach($request->tag as $tag){
            if($count < $request->old_tag_count){
                // if old tag != new tag
                if(Tag::where('id', $request->old_tag_id[$count])->first()->tag !== $tag){
                    if(!is_Null($tag)){
                        // both old and new exist
                        $this->deleteTag($request, $count);
                        $new_tag_id = $this->storeTag($tag, $new_tag_id);
                    }else{
                        // only old exists
                        $this->deleteTag($request, $count);
                    }
                }
            }else{
                if(!is_Null($tag)){
                    // only new exists
                    $new_tag_id = $this->storeTag($tag, $new_tag_id);
                }
            }
            $count++;
        }

        return redirect()->route('profile.index');
    }

    private function storeTag($tag, $new_tag_id){
        $db_tags = Tag::get();
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->tag === $tag){
                $is_new = false;
                // create UserTag
                UserTag::create([
                    'user_id' => Auth::id(),
                    'tag_id'  => $db_tag->id,
                ]);
            }
        }
        if($is_new){
            // create new Tag
            Tag::create([
                'tag' => $tag,
            ]);

            // create UserTag
            UserTag::create([
                'user_id' => Auth::id(),
                'tag_id'  => $new_tag_id,
            ]);
            $new_tag_id++;
        }

        return $new_tag_id;
    }

    private function deleteTag($request, $count){
        // delete old UserTag
        UserTag::where('tag_id', $request->old_tag_id[$count])->where('user_id', Auth::id())->delete();
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            // name email tag password introduction
            'avatar' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        $user = User::find(Auth::id());

        // delete the previous file from the local storage
        $this->deleteAvatar($user->avatar);

        // save data to user table and store avatar file
        User::where('id', Auth::id())
        ->update([
            'avatar'   => $this->saveAvatar($request),
        ]);

        return redirect()->route('profile.index');
    }

    private function saveAvatar($request){
        // Change the name of the avatar to Current Time to avoid overwriting.
        $avatar_name = time() . "." . $request->avatar->extension();

        // Save the avatar inside the storage/app/public/avatars
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    private function deleteAvatar($avatar_name)
    {
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if(Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('index');
    }
}
