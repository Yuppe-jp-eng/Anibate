<?php

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

use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', 'HomeController@top');



Route::namespace('Post')->group(function(){
    Route::resource('/posts', 'PostController')->except(['index']);
    Route::get('/posts/works/{title}', 'PostController@anime_index');
});