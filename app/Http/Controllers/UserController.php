<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $main_tags = getMainTags(); // from helpers.php
        $fav_tags  = getFavTags(); // from helpers.php
        return view('users.profiles.show', compact('user', 'main_tags', 'fav_tags'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $main_tags = UserTag::where('user_id', $user->id)->where('tag_category', 'main')->latest()->get();
        $fav_tags = UserTag::where('user_id', $user->id)->where('tag_category', 'favorite')->latest()->get();

        return view('users.profiles.show', compact('user', 'main_tags', 'fav_tags'));
    }

    public function edit($id)
    {
        $user           = Auth::user();
        $main_tags      = getMainTags(); // from helpers
        $fav_tags       = getFavTags(); // from helpers

        return view('users.profiles.edit', compact('user', 'main_tags', 'fav_tags'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'username'     => 'required|max:100',
            'email'        => 'required|max:100|email',
            'introduction' => 'max:10000|nullable',
        ]);

        $user->username     = $request->username;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;
        $user->save();

        return redirect()->route('profiles.index');
    }
}
