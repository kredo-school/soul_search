<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function store(Chat $chat){
        $chat->likes()->attach(Auth::id());

        return redirect()->back();
    }

    public function destroy(Chat $chat){
        $chat->likes()->detach(Auth::id());

        return redirect()->back();
    }
}
