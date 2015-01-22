<?php

use Faker\Factory as F;

class EpisodeTableSeeder extends Seeder {

	const MAX = 10;
	
	public function run()
    {
		$f = F::create();
        DB::table('episodes')->delete();
		for ($i=0;$i<self::MAX;$i++) {
			Episode::create(array(
				'title' => $f->name,
				'description' => $f->name
			));
		}
    }

}
