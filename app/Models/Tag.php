<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function chats(){
        return $this->hasMany(Chat::class)->latest();
    }

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function userTag(){
        return $this->hasMany(UserTag::class);
    }

    public function isMain(){
        return $this->userTag()->where('tag_category', config('enums')['tag_category']['main'])->exists();
    }

    public function isFav(){
        return $this->userTag()->where('tag_category', config('enums')['tag_category']['favorite'])->exists();
    }
}
