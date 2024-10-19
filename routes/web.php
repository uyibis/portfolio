<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [PostsController::class, 'index'])->name('index');

// Resource routes to generate all posts routes.
Route::resource('posts', PostsController::class);
Route::post('/posts/preview', [PostsController::class, 'preview'])->name('posts.preview');

Route::get('projects', [PostsController::class, 'list'])->name('posts.list');
