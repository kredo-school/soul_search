<?php

use App\Http\Controllers\UserController;
<<<<<<< HEAD
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
=======
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
>>>>>>> main
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

    #CHAT
    Route::post('/tag/{tag_id}/chats', [ChatController::class, 'store'])->name('chat.store');

    #TAG
    Route::post('/tag/{tag_id}/store', [TagController::class, 'store'])->name('tag.store');

    #LIKE
    Route::post('/like/{chat_id}/store', [LikeController::class, 'store'])->name('chat.like.store');
    Route::delete('/like/{chat_id}/destroy', [LikeController::class, 'destroy'])->name('chat.like.destroy');

    #Profile(User)
<<<<<<< HEAD
    Route::resource('/profiles', UserController::class);
    #Avatar
    Route::resource('/avatars', AvatarController::class);
    #Password
    Route::resource('/passwords', ChangePasswordController::class);
    #Follow
    Route::resource('/users/{user}/follows', FollowController::class);
=======
    Route::resource('/profile', UserController::class);
>>>>>>> main

    #Post
    Route::resource('/posts', PostController::class);
    #PostLike
    Route::resource('/posts/{post}/responses', PostLikeController::class);

    #Comment
    Route::resource('/posts/{post}/comments', CommentController::class);
    #CommentLike
    Route::resource('/posts/{post}/comments/{comment}/reactions', CommentLikeController::class);
<<<<<<< HEAD
=======
    #CONTACT
    Route::resource('/contact', ContactController::class);
>>>>>>> main
});


