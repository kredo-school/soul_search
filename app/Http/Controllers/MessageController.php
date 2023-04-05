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
        $request->validate([
            'text'  => 'required_if:image,=,null|nullable|string',
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000'
        ]);

        $text = $request->text;
        $image = null;
        if($request->image) {
                $image = $this->saveImage($request);
        }

        $user->messagesReceived()->attach(Auth::id(), [
                'image' => $image,
                'text' => $text
        ]);

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

    public function update(Request $request, User $user, $message_id)
    {
        $request->validate([
            'text'  => 'string',
        ]);

        $user->messagesReceived()->updateExistingPivot($message_id, [
            'text' => $request->text,
        ]);

        return redirect()->route('messages.show', $user->id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function destroy($user_id, $message_id)
    {
        $user = User::find($user_id);
		$user->messagesReceived()->detach([
			'id' => $message_id,
		]);

        return redirect()->back();
    }
}
