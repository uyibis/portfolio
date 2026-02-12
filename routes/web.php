<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LandingController;
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

Route::view('/welcome', 'welcome')->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [PostsController::class, 'index'])->name('index');

Route::get('/landing-2', [LandingController::class, 'landing2'])->name('landing2');

// Resource routes to generate all posts routes.
Route::resource('posts', PostsController::class);
Route::post('/posts/preview', [PostsController::class, 'preview'])->name('posts.preview');
Route::patch('/posts/{post}/toggle-publish', [PostsController::class, 'togglePublish'])->name('posts.togglePublish');

// Projects have their own routes (separate from posts).
Route::resource('projects', PostsController::class)->names('projects');
Route::post('/projects/upload-images', [PostsController::class, 'uploadProjectImages'])->name('projects.uploadImages');
Route::post('/projects/preview', [PostsController::class, 'preview'])->name('projects.preview');
Route::patch('/projects/{project}/toggle-publish', [PostsController::class, 'togglePublish'])->name('projects.togglePublish');

// Gallery/list page (kept separate from /projects resource index to avoid conflicts)
Route::get('/projects-gallery', [PostsController::class, 'list'])->name('projects.list');