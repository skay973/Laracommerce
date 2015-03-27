<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->increments('id');
			$table->integer('billing_address_id')->unsigned()->nullable();
			$table->foreign('billing_address_id')->references('id')->on('addresses');
			$table->integer('shipping_address_id')->unsigned()->nullable();
			$table->foreign('shipping_address_id')->references('id')->on('addresses');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('password');
			$table->string('phone');
			$table->string('mobile');
			$table->boolean('admin')->default(0);
			$table->string('remember_token');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
