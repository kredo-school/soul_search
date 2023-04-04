<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(){
        $users = User::all()->except(Auth::id());
        $tags  = Tag::all();

        return view('users.search.index', compact('users', 'tags'));
    }
}
