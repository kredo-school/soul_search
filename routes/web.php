<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;

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

    Route::resource('/profile', UserController::class);
    Route::resource('/post', PostController::class);
    Route::resource('/comment', CommentController::class);
});


