<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name'];

    public function chats(){
        return $this->hasMany(Chat::class)->latest();
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function userTag(){
        return $this->hasMany(UserTag::class)->orderByDesc('last_access');
    }

    public function isRecent(){
        return $this->userTag()->where('last_access')->exists();
    }

    public function isMain(){
        return $this->userTag()->where('tag_category', config('enums')['tag_category']['main'])->exists();
    }

    public function isFav(){
        return $this->userTag()->where('tag_category', config('enums')['tag_category']['favorite'])->exists();
    }

    public function postTags()
    {
        return $this->hasMany(PostTag::class)->latest();
    }

    public function userTags()
    {
        return $this->hasMany(UserTag::class)->latest();
    }
}
