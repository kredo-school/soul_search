<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(Request $request){
        if(Follow::onlyTrashed()->where('following_id', Auth::id())->where('followed_id', $request->user_id)->exists()){
            Follow::onlyTrashed()->where('following_id', Auth::id())->where('followed_id', $request->user_id)->restore();
        }else{
            Follow::create([
                'following_id' => Auth::id(),
                'followed_id'  => $request->user_id,
            ]);
        }

        return redirect()->back();
    }

    public function destroy($id){
        Follow::where('following_id', Auth::id())
              ->where('followed_id', $id)
              ->delete();

        return redirect()->back();
    }
}
