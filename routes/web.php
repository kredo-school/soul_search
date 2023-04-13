<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;

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


Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    #CHAT
    Route::get('/chats/{tag_id}/show', [ChatController::class, 'show'])->name('chats.show');
    Route::post('chat/{tag_id}/store', [ChatController::class, 'store'])->name('chat.store');

    #LIKE
    Route::post('/like/{chat_id}/store', [LikeController::class, 'store'])->name('chat.like.store');
    Route::delete('/like/{chat_id}/destroy', [LikeController::class, 'destroy'])->name('chat.like.destroy');

    #Profile(User)
    Route::resource('/profiles', UserController::class, ['only' => ['index', 'show', 'edit', 'update']]);
    #Avatar
    Route::resource('/avatars', AvatarController::class, ['only' => ['edit', 'update', 'destroy']]);
    #Password
    Route::resource('/passwords', ChangePasswordController::class, ['only' => ['edit', 'update']]);
    #Follow
    Route::resource('/users/{user}/follows', FollowController::class, ['only' => ['store', 'destroy']]);

    #Post
    Route::resource('/posts', PostController::class, ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    #PostLike
    Route::resource('/posts/{post}/responses', PostLikeController::class, ['only' => ['store', 'destroy']]);

    #Comment
    Route::resource('/posts/{post}/comments', CommentController::class, ['only' => ['store', 'destroy']]);
    #CommentLike
    Route::resource('/posts/{post}/comments/{comment}/reactions', CommentLikeController::class, ['only' => ['store', 'destroy']]);

    #Message
    Route::resource('/users/{user}/messages', MessageController::class,  ['only' => ['store', 'update', 'destroy']]);
    #Message show
    Route::get('/users/{user}/messages/', [MessageController::class, 'show'])->name('messages.show');

    #Search
    Route::resource('/search', SearchController::class, ['only' => ['index']]);

    #Contact
    Route::resource('/contact', ContactController::class, ['only' => ['index', 'store', 'destroy']]);

    #Report
    Route::resource('/reports', ReportController::class, ['only' => ['store']]);
});


