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

        // divide text and hushtags
        $body_divided = explode('#', $request->body);

        // create data in posts table
        Post::create([
            'body'    => $body_divided[0],
            'user_id' => Auth::id(),
            'image'   => $this->saveImage($request),
        ]);

        // remove text and leave tags
        $body_divided = array_splice($body_divided, 1);

        // store Tag and PostTag
        $latest_tag_id = Tag::max('id');
        $new_tag_id    = $latest_tag_id + 1;
        foreach($body_divided as $tag){
            if(!is_Null($tag)){
                $new_tag_id = $this->storePostTag(Post::latest()->first()->id, trim($tag), $new_tag_id);
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

    private function storePostTag($id, $tag, $new_tag_id){
        $db_tags = Tag::get();
        //check if tag is new
        $is_new = true;
        foreach($db_tags as $db_tag){
            if($db_tag->tag == $tag){
                $is_new = false;
                PostTag::create([
                    'post_id' => $id,
                    'tag_id'  => $db_tag->id,
                ]);
            }
        }
        if($is_new){
            Tag::create([
                'tag' => $tag,
            ]);
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
        $old_tag_ids = [];
        foreach($post_tags as $post_tag){
            $tag = Tag::find($post_tag->tag_id)->tag;
            $post->body .= ' #' . $tag;
            $old_tag_ids[] = $post_tag->tag_id;
        }

        // if not the owner of the post, redirect to homepage
        if(Auth::id() !== $post->user->id):
            return redirect()->route('index');
        endif;

        return view('users.profiles.posts.edit', compact('post', 'old_tag_ids'));
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

        // divide text and hushtags
        $body_divided = explode('#', $request->body);

        Post::where('id', $id)
            ->update([
                'body'    => $body_divided[0],
        ]);

        $post = Post::find($id);

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

        // remove text and leave tags
        $body_divided = array_splice($body_divided, 1);

        // Tag and PostTag update
        $latest_tag_id      = Tag::max('id');
        $new_tag_id         = $latest_tag_id + 1;
				if($request->old_tag_ids){
						$number_of_old_tags = count($request->old_tag_ids);
				}else{
					$number_of_old_tags = 0;
				}
        $number_of_new_tags = count($body_divided);
        $count = 0;
        for($i = 0; $i < $number_of_old_tags && $i < $number_of_new_tags; $i++){
            // check if old and new are same number or not
            if(Tag::where('id', $request->old_tag_ids[$i])->first()->tag !== trim($body_divided[0])){
                // delete old and store new
                $this->deletePostTag($request, $i, $id);
                $new_tag_id = $this->storePostTag($id, trim($body_divided[0]), $new_tag_id);
            }
            // remove the tag already stored
            $body_divided = array_splice($body_divided, 1);
            $count++;
        }

        // when more old tags
        if($number_of_old_tags > $number_of_new_tags){
            for($i = $count; $i < $number_of_old_tags; $i++){
                $this->deletePostTag($request, $i, $id);
            }
        }

        // when more new tags
        if($number_of_old_tags < $number_of_new_tags){
            foreach($body_divided as $tag){
                $new_tag_id = $this->storePostTag($id, trim($tag), $new_tag_id);
            }
        }

        return redirect()->route('posts.show', $id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    private function deletePostTag($request, $count, $post_id){
        // delete old PostTag
        PostTag::where('tag_id', $request->old_tag_ids[$count])->where('post_id', $post_id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->deleteImage($post->image);
        $post->delete();

        return redirect()->route('profile.index');
    }
}
