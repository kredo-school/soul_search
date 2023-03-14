<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FormController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register',[RegisterController::class, 'index'])->name('register');
// Route::post('/store',[RegisterController::class, 'store'])->name('store');
Route::get('/tag_register',[TagRegisterController::class, 'index'])->name('tag_register');
Route::post('/tag_register/store',[TagRegisterController::class, 'store'])->name('tag.store');
