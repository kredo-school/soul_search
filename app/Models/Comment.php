<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> origin/demo/for-taka-san
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['post_id','user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likes()
    {
<<<<<<< HEAD
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')->withPovot('id');
    }

    public function like($user_id)
    {
        return $this->likes()->where('user_id', '=',  $user_id)->first();
    }
=======
        // return $this->hasMany(CommentLike::class);
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')->withPivot('id');
    }

    public function like($user_id) {
        return $this->likes()->where('user_id', '=',  $user_id)->first();
    }

    // public function isLiked($user_id)
    // {
    //     return $this->likes()->where('user_id', '=',  $user_id)->exists();
    // }

>>>>>>> origin/demo/for-taka-san
}
