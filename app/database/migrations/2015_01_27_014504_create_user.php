<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users',function($t){
			$t->increments('id')->unsigned();
			$t->string('email')->unique();
			$t->string('password');
			$t->integer('quizlet_user_id')->unsigned()->nullable();
			$t->foreign('quizlet_user_id')->references('id')
			->on('quizlet_users');
			$t->timestamps();
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
