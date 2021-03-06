<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::route('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Role and permissions Filters
|--------------------------------------------------------------------------
|
| Filters using Entrust package to check for Roles and Permissions
|
*/

// Entrust::routeNeedsRole( 'admin/*', 'Admin', Redirect::to('/') );
// Entrust::routeNeedsRole( 'admin/*', 'Writer', Redirect::to('/') );


Route::filter('role_admin_writer_member', function()
{
	$permissionerror = "You don't have the right permissions to access this page!";
	if (
		! Entrust::hasRole('Admin') and 
		! Entrust::hasRole('Writer') and
		! Entrust::hasRole('Member')
	)
	{
		return Redirect::to('/')
			->with( 'flasherror', $permissionerror );
	}
});
Route::when('admin/*', 'role_admin_writer_member');

Entrust::routeNeedsPermission( 'admin/post*', 'manage_posts', Redirect::to('admin') );
Entrust::routeNeedsPermission( 'admin/user*', 'manage_users', Redirect::to('admin') );

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});