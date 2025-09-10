<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentNotificationController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('posts/{post}/comments', 'store')->name('posts.comments.store');
    Route::delete('posts/comments/{comment}', 'destroy')->name('comments.destroy');
});

Route::controller(LikeController::class)->group(function () {
    Route::post('posts/{post}/like', 'toggleLike')->name('posts.toggleLike');
});

Route::get('notifications', [CommentNotificationController::class, 'index'])
    ->name('notifications.index');
