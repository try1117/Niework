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

//Route::post('/edit', 'UserController@updateAvatar')->name('update_avatar');
Route::post('/edit', 'UsersController@update')->name('update');
