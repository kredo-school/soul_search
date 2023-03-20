<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Tag;
use App\Models\UserTag;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    use RegistersUsers;

    private $start_tag;

    public function __construct(Tag $start_tag)
    {
        $this->start_tag = $start_tag;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tag_name' => ['required', 'min:1', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function index(){
        return view('auth.register');
    }

    protected function create(array $data)
    {
        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user_id = $user->id;
        // $db_tags = Tag::get();

        // foreach ($data["tag_name"] as $tag)
        // {
        //     $dbtags = Tag::where('tag', '=' ,$tag)->get(); //Get all the tags that has the similar name in database [example: book == book]
        //     $count = $dbtags->count(); //Then if we found similar tags already in the database, the tag count will increase

        //     //If we then have 0 count in db tags we create the tag
        //     if (count($dbtags) == 0)
        //     {
        //         $tag = Tag::create(['tag'=>$tag]);
        //         $user_tag[] = ['tag_id' => $dbtags["id"], 'user_id' => $user_id, 'tag_category' => 'main'];
        //         UserTag::insert($user_tag);
        //     }
        //     else
        //     {
        //         $user_tag[] = ['tag_id' => $dbtags["id"], 'user_id' => $user_id, 'tag_category' => 'main'];
        //         UserTag::insert($user_tag);
        //     }
        // }

        for ($i = 0; $i <= count($data['tag_name']); $i++)
        {
            $dbtags = Tag::where('tag', '=' ,$data["tag_name"][$i])->get(); //Get all the tags that has the similar name in database [example: book == book]
            $count = $dbtags->count(); //Then if we found similar tags already in the database, the tag count will increase
            dd($dbtags["id"]);
            //If we then have 0 count in db tags we create the tag
            if (count($dbtags) == 0)
            {
                $tag = new Tag();
                $tag->tag = $data['tag_name'][$i];
                $tag->save();
                // $tag = Tag::create(['tag'=>$tag]);
                $user_tag[] = ['tag_id' => $tag->id, 'user_id' => $user_id, 'tag_category' => 'main'];
                UserTag::insert($user_tag);
            }
            else
            {
                $user_tag[] = ['tag_id' => $dbtags["id"], 'user_id' => $user_id, 'tag_category' => 'main'];
                UserTag::insert($user_tag);
            }
        }


        return $user;
    }
}
