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

#トップ画面
Route::get('/', 'HomeController@top')->name('top');

#投稿
Route::namespace('Post')->group(function(){
    Route::resource('/posts', 'PostController')->except(['index'])->middleware('auth');
    Route::get('/posts/works/{title}', 'PostController@anime_index')->name('title_index');
});

#いいね
Route::namespace('Favorite')->group(function(){
    Route::prefix('posts')->name('favorites.')->group(function(){
    Route::put('/{post}/like', 'FavoriteController@like')->name('like')->middleware('auth');
    Route::delete('/{post}/like', 'FavoriteController@unlike')->name('unlike')->middleware('auth');
    });

});

#検索機能
Route::namespace('Work')->group(function(){
    Route::resource('works', 'WorkController', ['only' => ['create', 'store', 'show']]);
    Route::get('searches', 'WorkController@search')->name('search');
});

#ユーザー詳細、フォロー、登録作品削除
Route::namespace('User')->prefix('users')->name('users.')->group(function(){
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/followers', 'FollowController@followers')->name('followers');
    Route::get('/{name}/followings', 'FollowController@followings')->name('followings');
    Route::middleware('auth')->group(function(){
        Route::get('/{name}/edit', 'UserController@edit')->name('edit');
        Route::patch('/{name}', 'UserController@update')->name('update');
        Route::delete('/{work_id}', 'UserController@delete_anime')->name('delete_anime');
        Route::get('/{name}/searches', 'UserController@search_my_works')->name('searches');
        Route::put('/{name}/follow', 'FollowController@follow')->name('follow');
        Route::delete('/{name}/follow', 'FollowController@unfollow')->name('unfollow');
    });
});