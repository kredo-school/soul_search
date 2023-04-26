<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index(Request $request, Post $post)
    {
        $all_posts = $post
        ->where('created_at')
        ->orWhere('text', 'like', '%')
        ->withTrashed()->latest()->paginate(5);

        return view('admin.posts.index')->with('all_posts', $all_posts);
    }

    public function hide(Post $post){
        $post->delete();
        return redirect()->back();
    }

    public function unhide(Post $post, $id){
        $post->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
