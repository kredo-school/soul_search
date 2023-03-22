<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
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
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')->withPivot('id');
    }

    public function like($user_id)
    {
        return $this->likes()->where('user_id', '=',  $user_id)->first();
    }
}
