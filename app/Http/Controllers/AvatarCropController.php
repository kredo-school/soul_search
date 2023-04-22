<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarCropController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';

    public function edit($id)
    {
        $user      = User::find($id);

        return view('users.profiles.avatars.crop', compact('user'));
    }

    public function update(Request $request)
    {
        dd($request->getContent('canvasData'));
        $image = $request->input('canvasData');
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        $user = User::find(Auth::id());

        $imageName = uniqid() . '.png';
        $filePath = 'public/avatars/' . $imageName;

        file_put_contents($filePath, $imageData);

        $user->avatar = $imageName;
        $user->save();

        return response()->json(['success' => true]);

    }

    private function save($request){
        // Change the name of the avatar to Current Time to avoid overwriting.
        $avatar_name = time() . "." . $request->avatar->extension();

        // Save the avatar inside the storage/app/public/avatars
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    private function delete($avatar_name)
    {
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if(Storage::disk('local')->exists($avatar_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }
}
