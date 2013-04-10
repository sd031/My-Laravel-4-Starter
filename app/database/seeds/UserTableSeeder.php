<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		$user = new User;
		$user->id                    = 1;
		$user->username              = 'Admin';
		$user->firstname             = 'Martin';
		$user->lastname              = 'Dilling-Hansen';
		$user->email                 = 'martindilling@gmail.com';
		$user->password              = 'password';
		$user->password_confirmation = 'password';
		$user->confirmed             = 1;
		$user->save();

		$user = new User;
		$user->id                    = 2;
		$user->username              = 'Writer';
		$user->firstname             = 'Camilla';
		$user->lastname              = 'Olsen';
		$user->email                 = 'martindilling@gmail.com';
		$user->password              = 'password';
		$user->password_confirmation = 'password';
		$user->confirmed             = 1;
		$user->save();

		$user = new User;
		$user->id                    = 3;
		$user->username              = 'Member';
		$user->firstname             = 'User';
		$user->lastname              = 'Name';
		$user->email                 = 'martindilling@gmail.com';
		$user->password              = 'password';
		$user->password_confirmation = 'password';
		$user->confirmed             = 1;
		$user->save();

		// Uncomment the below to run the seeder
		// DB::table('usertableseeder')->insert($usertableseeder);
	}

}
