<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});
 Route::prefix('posts')->controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('posts.index');
        Route::get('/create', 'create')->name('posts.create');
        Route::post('/', 'store')->name('posts.store');
        Route::get('/{post}', 'show')->name('posts.show');
        Route::get('/{post}/edit', 'edit')->name('posts.edit');
        Route::put('/{post}', 'update')->name('posts.update');
        Route::delete('/{post}', 'destroy')->name('posts.destroy');
    });