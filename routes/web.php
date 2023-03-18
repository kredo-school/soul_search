<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::resource('/profile', UserController::class);
    #Avatar
    Route::resource('/avatar', AvatarController::class);
    #Password
    Route::resource('/passwords', ChangePasswordController::class);

    #Follow
    Route::resource('/follow', FollowController::class);

    #Post
    Route::resource('/post', PostController::class);
    #PostLike
    Route::resource('/postlike', PostLikeController::class);

    #Comment
    Route::resource('/comment', CommentController::class);
    #CommentLike
    Route::resource('/commentlike', CommentLikeController::class);

});

