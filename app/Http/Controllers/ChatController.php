<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $chat;
    private $tag;
    private $user;

    public function __construct(Chat $chat, Tag $tag, User $user){
        $this->chat = $chat;
        $this->tag  = $tag;
        $this->user = $user;
    }


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

    public function show(Tag $tag){
        $recent_tags = getRecentTags();
        $main_tags = getMainTags();
        $fav_tags = getFavTags();

        $tagged_chats = Chat::where('tag_id',$tag->id)->get()->filter(function($chat){
            return $chat->tag->isMain() || $chat->tag->isFav() || $chat->tag->isRecent();
        });

        return view('show')
            ->with('tag', $tag)
            ->with('tagged_chats', $tagged_chats)
            ->with('recent_tags', $recent_tags)
            ->with('main_tags', $main_tags)
            ->with('fav_tags', $fav_tags);
    }

    public function destroy($id){
        $chat = $this->chat->findOrFail($id);
        $this->deleteImage($chat->image);
        $chat->forceDelete();
        return redirect()->route('show');
    }
}
