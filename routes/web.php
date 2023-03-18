<?php

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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    #CHAT
    Route::post('chat/{tag_id}/store', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chats/{tag_id}/show', [ChatController::class, 'show'])->name('chats.show');

    #LIKE
    Route::post('/like/{chat_id}/store', [LikeController::class, 'store'])->name('chat.like.store');
    Route::delete('/like/{chat_id}/destroy', [LikeController::class, 'destroy'])->name('chat.like.destroy');
});

