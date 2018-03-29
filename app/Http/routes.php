<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Main area...
Route::get('/', function () 
{
    return view('login');
});

Route::get('admin_view', function () 
{
    return view('auth.admin_view');
});


// Authentication routes...
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


//guna yg ni...
Route::get('work_shop', 'AdminController@viewtow');
Route::get('profile/{id}', 'AdminController@profile');
Route::get('profile/delete/{id}', 'AdminController@delProfile');
Route::post('search', 'AdminController@SearchProfile');
Route::get('admin/edit/{id}', 'AdminController@EditProfile');
Route::post('profile/update', 'AdminController@updateProfile');

Route::get('admin/profile/{id}', 'AdminController@AdminProfile');
Route::get('edit/admin/{id}', 'AdminController@EditAdmin');
Route::post('profile/update/ad', 'AdminController@updateAdmin');

Route::get('police', 'AdminController@viewPolice');
Route::get('add/police', 'AdminController@add');
Route::post('add/station', 'AdminController@newStation');
Route::post('update/station', 'AdminController@upStation');
Route::get('edit/Police/{id}', 'AdminController@EditPolice');
Route::get('police/delete/{id}', 'AdminController@delPolice');

Route::get('scrap', 'TipsController@site1');
Route::get('scrap2', 'TipsController@site2');
Route::get('tip/{gb}', 'TipsController@viewTips');
Route::get('mtip', 'TipsController@mainTips');
Route::get('view/tips/{id}', 'TipsController@openTips');
Route::get('tip/delete/{id}', 'TipsController@deltips');

Route::get('testing', 'TipsController@test');
Route::get('testing2', 'TipsController@test2');
