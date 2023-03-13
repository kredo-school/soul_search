<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.profiles.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body'  => 'required|min:1|max:10000',
            'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        // create data in posts table
        Post::create([
            'body'    => $request->body,
            'user_id' => Auth::id(),
            'image'   => $this->saveImage($request),
        ]);

        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        foreach($request->tag as $tag){
            if(!is_Null($tag)){
                $new_tag_id = $this->storeTag(Post::latest()->first()->id, $tag, $new_tag_id);
            }
        }

        return redirect()->route('profile.index');
    }

    private function saveImage($request){
        // Change the name of the image to Current Time to avoid overwriting.
        $image_name = time() . "." . $request->image->extension();

        // Save the image inside the storage/app/public/images
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    private function storeTag($id, $tag, $new_tag_id){
        $db_tags = Tag::get();
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->tag === $tag){
                $is_new = false;
                // create data in post_tags table
                PostTag::create([
                    'post_id' => $id,
                    'tag_id'  => $db_tag->id,
                ]);
            }
        }
        if($is_new){
            // create new Tag
            Tag::create([
                'tag' => $tag,
            ]);

            // create new PostTag
            PostTag::create([
                'post_id' => $id,
                'tag_id'  => $new_tag_id,
            ]);
            $new_tag_id++;
        }

        return $new_tag_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        Post::where('id', $id)
            ->update([
                'view_count' => $post->view_count + 1,
        ]);

        $post_tags = PostTag::where('post_id', $id)->get();
        $tags      = [];
        foreach($post_tags as $post_tag){
            $tags[] = Tag::find($post_tag->tag_id);
        }
        return view('users.profiles.posts.show', compact('post', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post      = Post::find($id);
        $post_tags = PostTag::where('post_id', $id)->get();
        $tags      = [];
        $tag_count = 0;
        foreach($post_tags as $post_tag){
            $tags[] = Tag::find($post_tag->tag_id);
            $tag_count++;
        }

        // if not the owner of the post, redirect to homepage
        if(Auth::id() !== $post->user->id):
            return redirect()->route('index');
        endif;

        return view('users.profiles.posts.edit', compact('post', 'tags', 'tag_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'body'  => 'min:1|max:10000',
            'image' => 'file|mimes:jpg,jpeg,png,gif|max:10000',
        ]);

        $post = Post::find($id);

        Post::where('id', $id)
            ->update([
                'body'    => $request->body,
        ]);

        // If there is a new image
        if($request->image){
            // Delete the previous file from the local storage
            $this->deleteImage($post->image);

            // save data to post table and store image file
            Post::where('id', $id)
            ->update([
                'image'   => $this->saveImage($request),
            ]);
        }

        // Tag and PostTag update
        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        $count         = 0;
        foreach($request->tag as $tag){
            if($count < $request->old_tag_count){
                // if old tag != new tag
                if(Tag::where('id', $request->old_tag_id[$count])->first()->tag !== $tag){
                    if(!is_Null($tag)){
                        // both old and new exist
                        $this->deleteTag($request, $count);
                        $new_tag_id = $this->storeTag($id, $tag, $new_tag_id);
                    }else{
                        // only old exists
                        $this->deleteTag($request, $count);
                    }
                }
            }else{
                if(!is_Null($tag)){
                    // only new exists
                    $new_tag_id = $this->storeTag($id, $tag, $new_tag_id);
                }
            }
            $count++;
        }

        return redirect()->route('post.show', $id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    private function deleteTag($request, $count){
        // delete old PostTag
        PostTag::where('tag_id', $request->old_tag_id[$count])->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return redirect()->route('profile.index');
    }
}
