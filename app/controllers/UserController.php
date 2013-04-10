<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends BaseController {

	/**
	 * Displays the form for account creation
	 *
	 */
	public function create()
	{
		$this->layout->content = View::make(Config::get('confide::signup_form'));
	}

	/**
	 * Stores new account
	 *
	 */
	public function store()
	{
		$user = new User;

		$user->username  = Input::get( 'username' );
		$user->firstname = Input::get( 'firstname' );
		$user->lastname  = Input::get( 'lastname' );
		$user->email     = Input::get( 'email' );
		$user->password  = Input::get( 'password' );

		// The password confirmation will be removed from model
		// before saving. This field will be used in Ardent's
		// auto validation.
		$user->password_confirmation = Input::get( 'password_confirmation' );

		// Save if valid. Password field will be hashed before save
		$user->save();

		if ( $user->id )
		{
			// Redirect with success message, You may replace "Lang::get(..." for your custom message.
			return Redirect::action('UserController@login')
				->with( 'flashsuccess', Lang::get('confide.alerts.account_created') );
		}
		else
		{
			// Get validation errors (see Ardent package)
			$error = $user->errors()->all(':message');

			return Redirect::action('UserController@create')
				->withInput(Input::except('password'))
				->with( 'flasherror', $error );
		}
	}

	/**
	 * Displays the login form
	 *
	 */
	public function login()
	{
		if( Confide::user() )
		{
			return Redirect::action('Admin\DashboardController@index');
		}
		else
		{
			$this->layout->content = View::make(Config::get('confide::login_form'));
		}
	}

	/**
	 * Attempt to do login
	 *
	 */
	public function do_login()
	{
		$input = array(
			'email'    => Input::get( 'email' ), // May be the username too
			'username' => Input::get( 'email' ), // so we have to pass both
			'password' => Input::get( 'password' ),
			'remember' => Input::get( 'remember' ),
		);

		// If you wish to only allow login from confirmed users, call logAttempt
		// with the second parameter as true.
		// logAttempt will check if the 'email' perhaps is the username.
		if ( Confide::logAttempt( $input ) ) 
		{
			// If the session 'loginRedirect' is set, then redirect
			// to that route. Otherwise redirect to '/'
			$r = Session::get('loginRedirect');
			if (!empty($r))
			{
				Session::forget('loginRedirect');
				return Redirect::to($r);
			}
			
			return Redirect::to('admin'); // change it to '/admin', '/dashboard' or something
		}
		else
		{
			// Check if there was too many login attempts
			if( Confide::isThrottled( $input ) )
			{
				$err_msg = Lang::get('confide.alerts.too_many_attempts');
			}
			else
			{
				$err_msg = Lang::get('confide.alerts.wrong_credentials');
			}

			return Redirect::action('UserController@login')
				->withInput(Input::except('password'))
				->with( 'flasherror', $err_msg );
		}
	}

	/**
	 * Attempt to confirm account with code
	 *
	 * @param  string  $code
	 */
	public function confirm( $code )
	{
		if ( Confide::confirm( $code ) )
		{
			$notice_msg = Lang::get('confide.alerts.confirmation');
			return Redirect::action('UserController@login')
				->with( 'flashsuccess', $notice_msg );
		}
		else
		{
			$error_msg = Lang::get('confide.alerts.wrong_confirmation');
			return Redirect::action('UserController@login')
				->with( 'flasherror', $error_msg );
		}
	}

	/**
	 * Displays the forgot password form
	 *
	 */
	public function forgot_password()
	{
		$this->layout->content = View::make(Config::get('confide::forgot_password_form'));
	}

	/**
	 * Attempt to send change password link to the given email
	 *
	 */
	public function do_forgot_password()
	{
		if( Confide::forgotPassword( Input::get( 'email' ) ) )
		{
			$notice_msg = Lang::get('confide.alerts.password_forgot');
			return Redirect::action('UserController@login')
				->with( 'flashsuccess', $notice_msg );
		}
		else
		{
			$error_msg = Lang::get('confide.alerts.wrong_password_forgot');
			return Redirect::action('UserController@forgot_password')
				->withInput()
				->with( 'flasherror', $error_msg );
		}
	}

	/**
	 * Shows the change password form with the given token
	 *
	 */
	public function reset_password( $token )
	{
		$this->layout->content = View::make(Config::get('confide::reset_password_form'))
									->with('token', $token);
	}

	/**
	 * Attempt change password of the user
	 *
	 */
	public function do_reset_password()
	{
		$input = array(
			'token'=>Input::get( 'token' ),
			'password'=>Input::get( 'password' ),
			'password_confirmation'=>Input::get( 'password_confirmation' ),
		);

		// By passing an array with the token, password and confirmation
		if( Confide::resetPassword( $input ) )
		{
			$notice_msg = Lang::get('confide.alerts.password_reset');
			return Redirect::action('UserController@login')
				->with( 'flashsuccess', $notice_msg );
		}
		else
		{
			$error_msg = Lang::get('confide.alerts.wrong_password_reset');
			return Redirect::action('UserController@reset_password', array('token'=>$input['token']))
				->withInput()
				->with( 'flasherror', $error_msg );
		}
	}

	/**
	 * Log the user out of the application.
	 *
	 */
	public function logout()
	{
		Confide::logout();
		
		return Redirect::to('/');
	}

}