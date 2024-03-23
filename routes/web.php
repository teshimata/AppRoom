<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::get('/posts/{post}/comments/create','create')->name('comment.create');
    Route::post('/posts/{post}/comments', 'store')->name('comment.store');
    Route::get('/posts/{post}/comments','index')->name('comment.index');
    Route::get('/posts/{post}/comments/{comment}', 'show')->name('comment.show');
    Route::put('/posts/{post}/comments/{comment}', 'update')->name('comment.update');
    Route::delete('/posts/{post}/comments/{comment}', 'delete')->name('comment.delete');
    Route::get('/posts/{post}/comments/{comment}/edit', 'edit')->name('comment.edit');
});

Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('likes.destroy');
});

require __DIR__.'/auth.php';
