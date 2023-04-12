<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class MessageController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images';

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
        $media_id = null;
        if($request->image) {
            $media_id = $this->saveImage($request);
        }

        $user->messagesReceived()->attach(Auth::id(), [
                'media_id' => $media_id,
                'text' => $text
        ]);

        return redirect()->back();
    }

    private function saveImage($request){
        // Change the name of the image to Current Time to avoid overwriting.
        $image_name = time() . "msg." . $request->image->extension();

        // Save the image inside the storage/app/public/images
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        // Save the path in the media table
        $media = new Media();
        $media->path = $image_name;
        $media->save();

        return $media->id;
    }

    public function show(User $user)
    {
        $all_users = User::latest()->get();

        $media = Media::latest()->get();

        $authUser = Auth::user();

        $pivot_items = collect($authUser->messagesSent)->merge($authUser->messagesReceived)->sortBy('pivot.created_at')
        ->filter(function($a) use($user){
            return $a->pivot->sender_id == $user->id || $a->pivot->receiver_id == $user->id;
        });

        return view('users.messages.show', compact('user', 'all_users', 'media', 'pivot_items'));
    }

    public function update(Request $request, User $user)
    {
        if($request->remove_data){
            if($request->text_data){
                $user->messagesReceived()->wherePivot('id', $request->message)->updateExistingPivot(Auth::id(), [
                    'text' => null,
                ]);
            }else{
                $this->deleteImage($request->image);
                $user->messagesReceived()->wherePivot('id', $request->message)->updateExistingPivot(Auth::id(), [
                    'media_id' => null,
                    'updated_at' => $user->messagesReceived()->wherePivot('id', $request->message)->first()->pivot->created_at,
                ]);
                Media::where('id', $request->media_id)->first()->delete();
            }
        }else{
            $request->validate([
                'text'  => 'string',
            ]);
            $user->messagesReceived()->wherePivot('id', $request->message)->updateExistingPivot(Auth::id(), [
                'text'        => $request->text,
                'text_edited' => true,
            ]);
        }

        return redirect()->route('messages.show', $user->id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function destroy(Request $request, User $user)
    {
        if($request->image){
            $this->deleteImage($request->image);
        }

        $user->messagesReceived()->wherePivot('id', $request->message)->detach([
			'sender_id' => Auth::id(),
		]);

        return redirect()->back();
    }
}
