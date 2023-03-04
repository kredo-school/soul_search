<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

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
        return view('users.posts.create');
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

        // // save data to post table
        $this->post->image    = $this->saveImage($request);

        $this->post->user_id  = Auth::user()->id;
        $this->post->body     = $request->body;
        $this->post->save();

        return redirect()->route('profile.index');
    }

    private function saveImage($request){
        // Change the name of the image to Current Time to avoid overwriting.
        $image_name = time() . "." . $request->image->extension();

        // Save the image inside the storage/app/public/images
        $request->image->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);

        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->findOrFail($id);
        return view('users.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        // if not the owner of the post, redirect to homepage
        if(Auth::user()->id != $post->user->id):
          return redirect()->route('index');
        endif;

        return view('users.posts.edit', compact('post'));
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
            'body'  => 'required|min:1|max:10000',
            'image' => 'mimes:jpg,jpeg,png,gif|max:100040|file',
        ]);

        // save data to post table
        $post        = $this->post->findOrFail($id);
        $post->body  = $request->body;

        // If there is a new image......
        if($request->image){
            // Delete the previous file from the local storage
            $this->deleteImage($post->image);

            // save data to post table
            $this->post->image = $this->saveImage($request);

            // Move the new image to local storage
            $post->image = $this->saveImage($request);
        }

        $post->save();
        return redirect()->route('post.show', $id);
    }

    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;

        if(storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);
        $this->deleteImage($post->image);
        $post->delete();

        return redirect()->route('post.show', $id);
    }
}
