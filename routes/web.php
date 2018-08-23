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




Route::get('login/facebook', 'Auth\LoginController@redirectToProviderFacebook')->name('auth.facebook');;
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallbackFacebook');


Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle')->name('auth.google');;
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::get('/', function () {
    $posts = App\Post::all();
    

    return view('home', compact('posts'));
});

Route::get('/home', function () {
    $menus = App\Menus::all();
    

    return view('home', compact('menus'));
});



