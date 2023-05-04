<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'avatars/';

    public function edit($id)
    {
        $user      = Auth::user();

        return view('users.profiles.avatars.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = User::find(Auth::id());

        if($user->avatar){
            $this->deleteAvatar($user->avatar);
        }

        $user->avatar = $this->saveAvatar($request);
        $user->save();

        return redirect()->route('profiles.edit', Auth::id());
    }

    private function saveAvatar($request){
        $avatar_name = time() . "." . $request->avatar->extension();
        Storage::disk('public')->putFileAs(self::LOCAL_STORAGE_FOLDER, $request->avatar, $avatar_name);

        return $avatar_name;
    }

    private function deleteAvatar($avatar_name)
    {
        $avatar_path = self::LOCAL_STORAGE_FOLDER . $avatar_name;

        if(Storage::disk('public')->exists($avatar_path)){
            Storage::disk('public')->delete($avatar_path);
        }
    }

    public function destroy($id)
    {
        User::where('id', Auth::id())
            ->update([
                'avatar' => NULL,
        ]);

        return redirect()->route('index');
    }
}
