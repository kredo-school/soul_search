<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['text','sender_id', 'receiver_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
