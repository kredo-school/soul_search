<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    use HasFactory;
    protected $table = 'user_tags';
    protected $fillable = ['user_id', 'tag_id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function isMain(){
        return $this->belongsTo(User::class, config('enums')['tag_category']['main']);
    }
    public function isFav(){
        return $this->belongsTo(User::class, config('enums')['tag_category']['favorite']);
    }
}
