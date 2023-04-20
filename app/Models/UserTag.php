<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTag extends Model
{
    use HasFactory;
    protected $table='user_tags';
    protected $fillable = ['user_id', 'tag_id', 'last_access', 'tag_category'];
    // public $timestamps = false;
    const UPDATED_AT = 'last_access';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function isRecent(){
        return $this->belongsTo(User::class);
    }

    public function isMain(){
        return $this->belongsTo(User::class, config('enums')['tag_category']['main']);
    }
    public function isFav(){
        return $this->belongsTo(User::class, config('enums')['tag_category']['favorite']);
    }

    public function updateLastAccess(){
        $this->last_access = \Carbon\Carbon::now();
        $this->save();
    }
}
