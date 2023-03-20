<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'user_tags';
    protected $fillable = ['user_id', 'tag_id'];

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
