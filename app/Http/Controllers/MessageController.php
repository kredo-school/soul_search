<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function index()
    {
        //
    }

    public function store(Request $request, User $user)
    {
        $text  = $request->text;
        $image = $request->image;
        if($text && $image){
            $request->validate([
                'text'  => 'string',
                'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
            ]);
            // save text
            $user->messagesReceived()->attach(Auth::id(), [
                'text'  => $text
            ]);
            // save image
            $image = $this->saveImage($request);
            $user->messagesReceived()->attach(Auth::id(), [
                'image'  => $image
            ]);

        }elseif($text){
            $request->validate([
                'text'  => 'string',
            ]);
            // save text
            $user->messagesReceived()->attach(Auth::id(), [
                'text'  => $text
            ]);

        }elseif($image){
            $request->validate([
                'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
            ]);
            // save image
            $image = $this->saveImage($request);
            $user->messagesReceived()->attach(Auth::id(), [
                'image'  => $image
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

    public function show(User $user)
    {
        $all_users = User::latest()->get();

        $authUser = Auth::user();

        $pivot_items = collect($authUser->messagesSent)->merge($authUser->messagesReceived)->sortBy('pivot.created_at')
        ->filter(function($a) use($user){
            return $a->pivot->sender_id == $user->id || $a->pivot->receiver_id == $user->id;
        });

        return view('users.messages.show', compact('user', 'all_users', 'pivot_items'));
    }

    public function update(Request $request, User $user, Message $message)
    {
        $request->validate([
                'text'  => 'string',
        ]);

        $message->text = $request->text;
        $message->save();

        return redirect()->route('messages.show', $user->id);
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
