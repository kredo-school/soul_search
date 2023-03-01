<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
