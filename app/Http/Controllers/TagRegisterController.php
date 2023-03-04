<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagRegisterController extends Controller
{
    private $tag;

    public function __construct(Tag $tag){
        $this->tag = $tag;
    }

    public function index(){
        return view('auth.tag_register');
    }

    public function store(Request $request){
        $request->validate([
            'tag_name' => 'required|min:1|max:255'
        ]);

        $this->tag->user_id = Auth::user()->id;
        $this->tag->tag_name = $request->tag_name;
        $this->tag->save();

        return redirect()->route('home');
    }
}
