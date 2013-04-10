<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('roles')->delete();
		DB::table('assigned_roles')->delete();

		$admin_role = new Role;
		$admin_role->name = 'Admin';
		$admin_role->permissions = array('view_membersarea', 'manage_posts','manage_users');
		$admin_role->save();

		$writer_role = new Role;
		$writer_role->name = 'Writer';
		$writer_role->permissions = array('view_membersarea', 'manage_posts');
		$writer_role->save();

		$member_role = new Role;
		$member_role->name = 'Member';
		$member_role->permissions = array('view_membersarea');
		$member_role->save();

		$user = User::where('username','=','admin')->first();
		$user->attachRole( $admin_role );

		$user = User::where('username','=','writer')->first();
		$user->attachRole( $writer_role );

		$user = User::where('username','=','member')->first();
		$user->attachRole( $member_role );
	}

}