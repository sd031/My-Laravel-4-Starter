<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->delete();
		DB::table('assigned_roles')->delete();

		$admin_role = new Role;
		$admin_role->name = 'Admin';
		$admin_role->permissions = array('manage_posts','manage_users');
		$admin_role->save();

		$writer_role = new Role;
		$writer_role->name = 'Writer';
		$writer_role->permissions = array('manage_posts');
		$writer_role->save();

		$user = User::where('username','=','admin')->first();
		$user->attachRole( $admin_role );

		$user = User::where('username','=','writer')->first();
		$user->attachRole( $writer_role );
	}

}