<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['text','user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'user_id')->withPivot('id');
    }

    public function like($user_id)
    {
        return $this->likes()->where('user_id', '=',  $user_id)->first();
    }

    public function postTags()
    {
        return $this->hasMany(PostTag::class);
    }
}
