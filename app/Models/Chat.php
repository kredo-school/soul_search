<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function tag(){
        return $this->belongsTo(Tag::class)->withTrashed();
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'chat_likes', 'chat_id', 'user_id');
    }

    public function isLiked(){
        return $this->likes()->wherePivot('user_id', Auth::user()->id)->exists();
    }
}
