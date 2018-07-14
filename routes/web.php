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

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect('login');
    }
    return redirect('home');
});

Auth::routes();
Route::resource('users', 'UsersController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/edit', 'EditProfileController@index')->name('edit');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/profile/{id}', 'UsersController@show')->name('profile');

Route::post('/edit', 'UsersController@updateAvatarPreview')->name('updateAvatarPreview');
Route::post('/edit', 'UsersController@update')->name('update');

Route::post('/create_post/{owner_id}', 'PostController@createPost')->name('createPost');
Route::post('/create_comment', 'CommentController@createComment')->name('createComment');
//Route::get('/create_comment', 'CommentController@showModal')->name('createComment');

Route::get('api/login', 'ExternalAuthController@auth');
Route::post('api/login', 'ExternalAuthController@redirectBack');
Route::post('api/token', 'ExternalAuthController@returnToken');
Route::get('api/profile/{id}', 'ExternalAuthController@getProfile');

Route::get('accept_auth_code/{external_id}', 'ExternalAuthController@acceptAuthCode');
