<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function edit($id)
    {
        $user      = User::find(Auth::id());
        $user_tags = UserTag::where('user_id', Auth::id())->get();
        $tags      = [];
        $tag_count = 0;
        foreach($user_tags as $user_tag){
            $tags[] = Tag::find($user_tag->tag_id);
            $tag_count++;
        }

        return view('users.profiles.passwords.edit', compact('user', 'tags', 'tag_count'));
    }

    public function update(Request $request)
    {
        // Password update
        if($request->new_password){
            $request->validate([
                'current_password'  => 'required|string',
                'new_password'      => 'required|confirmed|min:8|string',
            ]);

             // The passwords matches
            if (!Hash::check($request->get('current_password'), Auth::user()->password))
            {
                return back()->with('error', "Current Password is Invalid");
            }

            // Current password and new password same
            if (strcmp($request->get('current_password'), $request->new_password) == 0)
            {
                return redirect()->back()->with("error", "New Password cannot be same as your current password.");
            }

            $password =  Hash::make($request->new_password);
            User::where('id', Auth::id())->update([
                    'password' => $password,
            ]);

        }

        return redirect()->route('profiles.edit', Auth::id());
    }

}
