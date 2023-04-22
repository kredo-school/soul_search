<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';

    public function edit($id)
    {
        $user      = User::find($id);

        return view('users.profiles.avatars.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'required|file|mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        $user = User::find(Auth::id());

        // delete the previous file from the local storage
        $this->delete($user->avatar);

        // save data to user table and store avatar file
        User::where('id', Auth::id())
        ->update([
            'avatar'   => $this->save($request),
        ]);

        return redirect()->route('avatars.edit', Auth::id());
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

    public function destroy($id)
    {
        $user = User::find(Auth::id());
        $this->delete($user->avatar);

        User::where('id', Auth::id())
            ->update([
                'avatar' => NULL,
        ]);

        return redirect()->route('index');
    }

}
