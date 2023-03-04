<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    private $tag;

    public function __construct(Tag $tag){
        $this->tag = $tag;
    }

    public function store(Request $request){
        $request->validate([
            'tag' => 'required|min:1|max:255'
        ]);

        $this->tag->tag = $request->tag;
        $this->tag->user_id = Auth::user()->id;
        $this->save();

        return redirect()->back();
    }
}
