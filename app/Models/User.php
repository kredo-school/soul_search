<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    const NAME_OF_CONSTANT = 'Kazu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function userTag(){
        return $this->hasMany(UserTag::class);
    }

    public function isMain(){
        return $this->hasMany(UserTag::class, config('enums')['tag_category']['main']);
    }

    public function isFav(){
        return $this->hasMany(UserTag::class, config('enums')['tag_category']['favorite']);
    }

    //follows
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->withPivot('id');
        // return $this->hasMany(Follow::class, 'followed_id');
    }

    public function followedBy($user_id)
    {
        return $this->follows()
            ->where('following_id', '=',  $user_id)->exists();
    }

    //messages
    public function messagesSent()
    {
        return $this->belongsToMany(User::class, 'messages', 'sender_id', 'receiver_id')
                    ->withPivot('id', 'text', 'media_id', 'text_edited')
                    ->withTimestamps();
    }

    public function messagesReceived()
    {
        return $this->belongsToMany(User::class, 'messages', 'receiver_id', 'sender_id')
                    ->withPivot('id', 'text', 'media_id', 'text_edited')
                    ->withTimestamps();
    }

    public function messageFrom($user_id)
    {
        return $this->messagesReceived()
            ->where('sender_id', '=',  $user_id)->latest('messages.id')->first();
    }

    public function messageTo($user_id)
    {
        return $this->messagesSent()
            ->where('receiver_id', '=',  $user_id)->latest('messages.id')->first();
    }
}
