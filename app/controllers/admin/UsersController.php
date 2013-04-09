<?php namespace Admin;

use User, Input, Confide, Redirect;

class UsersController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate(8);

		$this->layout->content = \View::make('admin.users.index')
			->with( 'users', $users );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = \View::make('admin.users.create')
			->with( 'action', 'Admin\UsersController@store')
			->with( 'method', 'POST');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;

		$user->username = Input::get( 'username' );
		$user->firstname = Input::get( 'firstname' );
		$user->lastname = Input::get( 'lastname' );
		$user->email = Input::get( 'email' );
		$user->password = Input::get( 'password' );
		$user->confirmed = (Input::get( 'confirmed' ) != null ? 1 : 0);

		$user->password_confirmation = Input::get( 'password_confirmation' );

		// Save if valid
		if ( $user->save() )
		{
			return Redirect::action('Admin\UsersController@index')
				->with( 'flashsuccess', 'User is saved!' );
		}
		else
		{
			// Get validation errors (see Ardent package)
			$error = $user->errors()->all();

			return Redirect::action('Admin\UsersController@create')
				->withInput(Input::except('password'))
				->with( 'flasherror', $error );
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		if(! $user)
			return Redirect::action('Admin\UsersController@index');

		$this->layout->content = \View::make('admin.users.edit')
			->with( 'user', $user )
			->with( 'action', 'Admin\UsersController@update')
			->with( 'method', 'PUT');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$user = Users::find( $id );

		$user->username = Input::get( 'username' );
		$user->firstname = Input::get( 'firstname' );
		$user->lastname = Input::get( 'lastname' );
		$user->email = Input::get( 'email' );
		$user->confirmed = (Input::get( 'confirmed' ) != null ? 1 : 0);

		// Save if valid
		if ( $user->save() )
		{
			return Redirect::action('Admin\UsersController@index')
				->with( 'flashsuccess', 'User updated' );
		}
		else
		{
			// Get validation errors (see Ardent package)
			$error = $user->errors()->all();

			return Redirect::action('Admin\UsersController@edit', ['id'=>$id])
				->withInput()
				->with( 'flasherror', $error );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		$user->delete();

		return Redirect::action('Admin\UsersController@index')
				->with( 'flashsuccess', 'User deleted!' );
	}

}