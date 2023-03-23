<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatLike extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='chat_likes';
    protected $fillable = ['chat_id','user_id'];
    public $timestamps = false;
}
