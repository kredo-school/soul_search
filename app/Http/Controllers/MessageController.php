<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function show(User $user)
    {
        $all_users = User::latest()->get();

        // redirect if user id is same as login user's id
        if($user->id === Auth::id()){
            return view('users.messages.index', compact('all_users'));
        }

        $messages = Message::where(function($query) use($user){
                $query->where(function($query) use($user){
                    $query->where('sender_id', '=', Auth::id())
                    ->where('receiver_id', '=', $user->id);
                })
                    ->orWhere(function($query) use($user){
                        $query->where('sender_id', '=', $user->id)
                        ->where('receiver_id', '=', Auth::id());
                    });
            })
            ->oldest()->get();

        return view('users.messages.show', compact('user', 'all_users', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        if($request->text && $request->image){
            $request->validate([
                'text'  => 'string',
                'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
            ]);
            Message::create([
                'text'        => $request->text,
                'sender_id'   => Auth::id(),
                'receiver_id' => $user->id,
            ]);
            Message::create([
                'image'       => $this->saveImage($request),
                'sender_id'   => Auth::id(),
                'receiver_id' => $user->id,
            ]);
        }elseif($request->text){
            $request->validate([
                'text'  => 'string',
            ]);
            Message::create([
                'text'        => $request->text,
                'sender_id'   => Auth::id(),
                'receiver_id' => $user->id,
            ]);
        }elseif($request->image){
            $request->validate([
                'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
            ]);
            Message::create([
                'image'       => $this->saveImage($request),
                'sender_id'   => Auth::id(),
                'receiver_id' => $user->id,
            ]);
        }
        return redirect()->back();
    }

    private function saveImage($request){
        // Change the name of the image to Current Time to avoid overwriting.
        $image_name = time() . "msg." . $request->image->extension();

        // Save the image inside the storage/app/public/images
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }
    public function destroy(User $user, Message $message)
    {
        if($message->image){
            $this->deleteImage($message->image);
        }
        $message->where('id', $message->id)->delete();

        return redirect()->back();
    }
}
