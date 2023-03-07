<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagRegisterController extends Controller
{
    private $start_tag;

    public function __construct(Tag $start_tag){
        $this->start_tag = $start_tag;
    }

    public function index(){
        return view('auth.tag_register');
    }

    public function store(Request $request){
        $request->validate([
            'tag_name' => 'required|min:1|max:255'
        ]);

        foreach($request->tag_name as $tag) {
            $data = [
                'is_main' => 1,
                'tag' => $tag,
                'user_id' => Auth::id()
            ];
            Tag::create($data);
        }
        return redirect()->route('home');
    }
}
