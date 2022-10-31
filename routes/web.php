<?php

use Illuminate\Routing\Route as RoutingRoute;
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

Route::get('/', function () {
    return redirect()->route('posts.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/posts/dashboard', [\App\Http\Controllers\ChartJSController::class]);

require __DIR__.'/auth.php';

Route::post('/posts/{post}/comments', [\App\Http\Controllers\PostController::class, 'storeComment'])
    ->name('posts.comments.store');

Route::get('/posts/search', [\App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

Route::get('/posts/deleteComment/{comment}', [\App\Http\Controllers\PostController::class, 'deleteComment'])->name('posts.deleteComment');

Route::resource('/posts', \App\Http\Controllers\PostController::class);

Route::resource('/tags', \App\Http\Controllers\TagController::class);

Route::resource('/types', \App\Http\Controllers\TypeController::class);

Route::resource('/processes', \App\Http\Controllers\ProcessController::class);

Route::get('/posts/like/{post}', [\App\Http\Controllers\PostController::class, 'like'])->name('posts.like');

Route::resource('/charts',\App\Http\Controllers\ChartJSController::class);




