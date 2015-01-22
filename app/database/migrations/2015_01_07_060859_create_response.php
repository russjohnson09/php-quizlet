<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponse extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_reviews',function($t){
			$t->increments('id');
			$t->boolean('correct');
			$t->integer('card_id')->unsigned();
			$t->foreign('card_id')->references('id')->on('cards')
			->onDelete('cascade');
			$t->timestamp('due_date');
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
		Schema::drop('card_reviews');
	}

}
