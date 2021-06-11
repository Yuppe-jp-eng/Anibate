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

#認証関連
Auth::routes();

#外部サービスログイン
Route::prefix('login')->name('login.')->group(function() {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
#外部サービス登録
Route::prefix('register')->name('register.')->group(function() {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});


Route::get('/', 'HomeController@top')->name('top');



Route::namespace('Post')->group(function(){
    Route::resource('/posts', 'PostController')->except(['index'])->middleware('auth');
    Route::get('/posts/works/{title}', 'PostController@anime_index');
});

