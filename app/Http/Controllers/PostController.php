<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\UserTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'posts/';

    public function create()
    {
        return view('users.profiles.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'  => 'required|max:10240',
            'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:8196',
        ]);

        // create data in posts table
        Post::create([
            'text'    => $request->text,
            'user_id' => Auth::id(),
            'image'   => $this->saveImage($request),
        ]);

        // store Tag and PostTag
        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        preg_match_all("/#(\\w+)/", $request->text, $hashtags);
        foreach($hashtags[1] as $tag_name){
            $new_tag_id = $this->storeTag(Post::latest()->first()->id, $tag_name, $new_tag_id);
        }

        return redirect()->route('profiles.index');
    }

    private function saveImage($request){
        $image_name = time() . "." . $request->image->extension();
        Storage::disk('public')->putFileAs(self::LOCAL_STORAGE_FOLDER, $request->image, $image_name);
        return $image_name;
    }

    private function storeTag($post_id, $tag_name, $new_tag_id){
        $db_tags = Tag::get();
        //check if tag is new
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->name == $tag_name){
                $is_new = false;
                // create only PostTag and UserTag
                PostTag::create([
                    'post_id' => $post_id,
                    'tag_id'  => $db_tag->id,
                ]);
                UserTag::create([
                    'user_id'      => Auth::id(),
                    'tag_id'       => $db_tag->id,
                    'tag_category' => 'favorite',
                ]);
            }
        }
        if($is_new){
            // Create Tag, PostTag, and UserTag
            Tag::create([
                'name' => $tag_name,
            ]);
            PostTag::create([
                'post_id' => $post_id,
                'tag_id'  => $new_tag_id,
            ]);
            UserTag::create([
                'user_id'      => Auth::id(),
                'tag_id'       => $new_tag_id,
                'tag_category' => 'favorite',
            ]);
            $new_tag_id++;
        }

        return $new_tag_id;
    }

    public function show(Post $post)
    {
        $post->view_count += 1;
        $post->save();

        return view('users.profiles.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $post_tags = PostTag::where('post_id', $post->id)->get();
        $old_tag_ids = [];
        foreach($post_tags as $post_tag){
            $old_tag_ids[] = $post_tag->tag_id;
        }

        // if not the owner of the post, redirect to homepage
        if(Auth::id() !== $post->user->id):
            return redirect()->route('index');
        endif;

        return view('users.profiles.posts.edit', compact('post', 'old_tag_ids'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'text'  => 'min:1|max:10240',
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:8196',
        ]);

        $post->text = $request->text;

        // If there is a new image
        if($request->image){
            $this->deleteImage($post->image);
            $post->image = $this->saveImage($request);
        }

        $post->save();

        // Tag and PostTag update
        $post_id = $post->id;
        preg_match_all("/#(\\w+)/", $request->text, $hashtags);
        $latest_tag_id      = Tag::max('id');
        $new_tag_id         = $latest_tag_id + 1;
				if($request->old_tag_ids){
						$number_of_old_tags = count($request->old_tag_ids);
				}else{
					$number_of_old_tags = 0;
				}
        $number_of_new_tags = count($hashtags[0]);
        $count = 0;
        for($i = 0; $i < $number_of_old_tags && $i < $number_of_new_tags; $i++){
            // check if old and new are same number or not
            if(Tag::where('id', $request->old_tag_ids[$i])->first()->name !== $hashtags[1][$i]){
                // delete old and store new
                $this->deletePostTag($request, $i, $post_id);
                $new_tag_id = $this->storeTag($post_id, $hashtags[1][$i], $new_tag_id);
            }
            $count++;
        }

        // when more old tags
        if($number_of_old_tags > $number_of_new_tags){
            for($i = $count; $i < $number_of_old_tags; $i++){
                $this->deletePostTag($request, $i, $post_id);
            }
        }

        // when more new tags
        if($number_of_old_tags < $number_of_new_tags){
            for($i = $count; $i < $number_of_new_tags; $i++){
                $new_tag_id = $this->storeTag($post_id, $hashtags[1][$i], $new_tag_id);
            }
        }

        return redirect()->route('posts.show', $post_id);
    }

    private function deletePostTag($request, $count, $post_id){
        // delete old PostTag
        PostTag::where('tag_id', $request->old_tag_ids[$count])->where('post_id', $post_id)->delete();
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('public')->exists($image_path)){
            Storage::disk('public')->delete($image_path);
        }
    }

    public function destroy(Post $post)
    {
        $this->deleteImage($post->image);
        $post->delete();

        return redirect()->route('profiles.index');
    }
}
