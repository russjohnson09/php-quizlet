<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->call('CardTableSeeder');
		
		//$this->call('EpisodeTableSeeder');
		$this->call('ShowTableSeeder');

		//$this->call('UserTableSeeder');
	}

}
