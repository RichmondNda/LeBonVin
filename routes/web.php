<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::get('/', function () {
    return Inertia::render('Acceuil', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});

Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('create.post');
Route::post('/posts/registre', 'App\Http\Controllers\PostController@store');
Route::get('/posts/index', 'App\Http\Controllers\PostController@index')->name('index.post');
Route::get('/posts/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('index.edit');
Route::post('/post/update/{id}','App\Http\Controllers\PostController@update');
Route::delete('/post/delete/{id}', 'App\Http\Controllers\PostController@destroy')->name('destroy.post');
Route::get('/posts/liste', 'App\Http\Controllers\PostController@list')->name('list.post');

// Partie des commentaire 


Route::get('/posts/comment/{id}', 'App\Http\Controllers\PostController@show')->name('comment.post');
Route::post('/posts/send/comment', 'App\Http\Controllers\CommentController@store');