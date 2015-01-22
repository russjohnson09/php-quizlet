<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenre extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('genres',function($t){
			$t->increments('id');
			$t->string('description')->unique();
			$t->timestamps();
		});
		
		Schema::table('shows',function($t){
			$t->integer('genre_id')->unsigned()->nullable();
			$t->foreign('genre_id')->references('id')->on('genres')
			->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{	
		Schema::table('shows',function($t){
			$t->dropForeign('shows_genre_id_foreign');
			$t->dropColumn('genre_id');
		});
		
		Schema::drop('genres');
	}

}
