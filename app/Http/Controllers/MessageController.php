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
    const LOCAL_STORAGE_FOLDER = 'messages/';

    public function index()
    {
        //
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'text'  => 'required_if:image,=,null|nullable|string',
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $text = $request->text;
        $media_id = null;
        if($request->image) {
            $image_name = $this->saveImage($request);
            $media = new Media();
            $media->path = $image_name;
            $media->save();
            $media_id = $media->id;
        }

        $user->messagesReceived()->attach(Auth::id(), [
                'media_id' => $media_id,
                'text' => $text
        ]);

        return redirect()->back();
    }

    private function saveImage($request){
        $image_name = time() . '.' . $request->image->extension();
        Storage::disk('public')->putFileAs(self::LOCAL_STORAGE_FOLDER, $request->image, $image_name);

        return $image_name;
    }

    public function show(User $user)
    {
        $users = User::latest()->get();
        $authUser = Auth::user();
        $media = Media::latest()->get();

        $all_users_array = [];
        foreach($users as $a_user){
            $message_from = $authUser->messageFrom($a_user->id);
            $message_to   = $authUser->messageTo($a_user->id);
            if($message_from){
                $from_id = $message_from->pivot->id;
            }else{
                $from_id = 0;
            }
            if($message_to){
                $to_id = $message_to->pivot->id;
            }else{
                $to_id = 0;
            }
            // get the latest id
            if($from_id > $to_id){
                $latest_id = $from_id;
            }else{
                $latest_id = $to_id;
            }
            $all_users_array[] = [
                'user'      => $a_user,
                'latest_id' => $latest_id,
            ];
        }
        foreach($all_users_array as $key => $value){
            $sort_keys[$key] = $value['latest_id'];
        }
        array_multisort($sort_keys, SORT_DESC, $all_users_array);

        $pivot_messages = collect($authUser->messagesSent)->merge($authUser->messagesReceived)->sortBy('pivot.created_at')
        ->filter(function($a) use($user){
            return $a->pivot->sender_id == $user->id || $a->pivot->receiver_id == $user->id;
        });

        return view('users.messages.show', compact('user', 'all_users_array', 'media', 'pivot_messages'));
    }

    public function update(Request $request, User $user)
    {
        if($request->remove_data){
            if($request->text_data){
                $user->messagesReceived()->wherePivot('id', $request->message)->updateExistingPivot(Auth::id(), [
                    'text' => null,
                ]);
            }else{
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

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
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
