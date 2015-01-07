<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieGenre extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shows',function($t){
			$t->dropForeign('shows_genre_id_foreign');
			$t->dropColumn('genre_id');
		});
		
		//Schema::drop('genres');
		
		Schema::create('genre_show',function($t){ //alphabetical order http://laravel.com/docs/4.2/eloquent
			$t->increments('id');
			$t->integer('show_id')->unsigned();
			$t->integer('genre_id')->unsigned();
			$t->foreign('genre_id')->references('id')->on('genres');
			$t->foreign('show_id')->references('id')->on('shows')
			->onDelete('cascade');
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
		Schema::table('shows',function($t){
			$t->integer('genre_id')->unsigned()->nullable();
			$t->foreign('genre_id')->references('id')->on('genres')
			->onDelete('cascade');
		});
		
		Schema::drop('genre_show');
	}

}
