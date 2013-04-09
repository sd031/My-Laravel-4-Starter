<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'PostsController@index');

Route::get('admin', 'UserController@login');

// Posts
Route::get(    'posts',                    'PostsController@index' );
Route::get(    'post',                     'PostsController@index' );
Route::get(    'post/{slug}',              'PostsController@show' );

// Admin/Posts
Route::get(    'admin/posts',              'Admin\PostsController@index' );
Route::get(    'admin/post',               'Admin\PostsController@index' );
Route::get(    'admin/post/create',        'Admin\PostsController@create' );
Route::post(   'admin/post',               'Admin\PostsController@store' );
Route::get(    'admin/post/{id}',          'Admin\PostsController@show' );
Route::get(    'admin/post/{id}/edit',     'Admin\PostsController@edit' );
Route::put(    'admin/post/{id}',          'Admin\PostsController@update' );
Route::delete( 'admin/post/{id}',          'Admin\PostsController@destroy' );

// Admin/Users
Route::get(    'admin/users',              'Admin\UsersController@index' );
Route::get(    'admin/users',              'Admin\UsersController@index' );
Route::get(    'admin/users/create',       'Admin\UsersController@create' );
Route::post(   'admin/users',              'Admin\UsersController@store' );
Route::get(    'admin/users/{id}',         'Admin\UsersController@show' );
Route::get(    'admin/users/{id}/edit',    'Admin\UsersController@edit' );
Route::put(    'admin/users/{id}',         'Admin\UsersController@update' );
Route::delete( 'admin/users/{id}',         'Admin\UsersController@destroy' );


// Confide routes
Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');


// Errors
App::missing(function($exception)
{
	return Redirect::action('PostsController@index');
});