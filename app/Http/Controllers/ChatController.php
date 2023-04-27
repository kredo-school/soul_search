<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Chat;
use App\Models\User;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function store(Tag $tag, Request $request){
        $request->validate([
            'chat' =>'required|min:1|max:255',
            'image' => 'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        #Check if the chat has an image
        $image = NULL;
        if(isset($request->image)){
            $image = $this->saveImage($request);
        }

        $tag->chats()->create([
            'user_id' => Auth::id(),
            'chat' => $request->chat,
            'image' => $image
        ]);

        return redirect()->back();
    }

    public function saveImage($request){
        $image_name = time() . "." . $request->image->extension();

        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        return $image_name;
    }

    public function deleteImage($image_name){
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function show(Tag $tag, User $user, UserTag $user_tag){
        $user = Auth::user();
        $recent_tags = getRecentTags();
        $main_tags = getMainTags();
        $fav_tags = getFavTags();
        // $user_tag->user_id = Auth::id();
        // $user_tag->tag_id = $tag->id;
        // $user_tag->last_access = \Carbon\Carbon::now();
        // $user_tag->save();

        $tagged_chats = Chat::where('tag_id',$tag->id)->get()->filter(function($chat){
            return $chat->tag->isMain() || $chat->tag->isFav() || $chat->tag->isRecent();
        });


        $user_tag = $tag->userTag()->where('user_id', $user->id)->first();
        // dd($user_tag, $user->id, $tag->name);
        if ($user_tag) {
            $user_tag->updateLastAccess();
        } else {
            $user_tag = new UserTag([
                'user_id' => $user->id,
                'tag_id' => $tag->id,
                'last_access' => now(),
            ]);
            $user_tag->save();
        }

        return view('show')
            ->with('tag', $tag)
            ->with('tagged_chats', $tagged_chats)
            ->with('recent_tags', $recent_tags)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags);
    }

    public function destroy(Chat $chat){
        $this->deleteImage($chat->image);
        $chat->forceDelete();
        return redirect()->route('show');
    }
}
