<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		$user = new User;
		$user->firstname = 'Kevin';
		$user->lastname = 'BERIC';
		$user->email = 'kevin.beric@gmail.com';
		$user->password = Hash::make('kikoolol973');
		$user->phone = '0684572112';
		$user->admin = 1;
		$user->save();
	}
}
