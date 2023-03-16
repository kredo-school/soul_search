<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['following_id', 'followed_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
