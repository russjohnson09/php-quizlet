<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShow extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shows',function($t){
			$t->increments('id');
			$t->string('title');
			$t->string('description')->nullable();
			$t->timestamps();
			$t->timestamp('deleted_at')->nullable();
		});
		
		Schema::table('episodes',function($t){
			$t->integer('show_id')->unsigned()->nullable();
			$t->foreign('show_id')->references('id')->on('shows')
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
		Schema::table('episodes',function($t){
			$t->dropForeign('episodes_show_id_foreign');
			$t->dropColumn('show_id');
		});
		
		Schema::drop('shows');
	}

}
