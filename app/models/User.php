<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Entrust\HasRole;

class User extends ConfideUser {
	use HasRole;

	protected $table = 'users';

	protected $hidden = array('password', 'confirmation_code');

	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
		'username'   => 'required|between:3,20',
		'firstname'  => 'required',
		'lastname'   => 'required',
		'email'      => 'required|email',
		'password'   => 'required|between:5,20|confirmed',
	);

	/**
	 * Has many posts
	 */
	public function posts()
	{
		return $this->hasMany( 'Post', 'author_id' );
	}

	/**
	 * Full Name
	 *
	 * @return string
	 */
	public function fullName()
	{
		return $this->firstname . ' ' . $this->lastname;
	}

}