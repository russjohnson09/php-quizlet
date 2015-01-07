<?php

use Faker\Factory as F;

class EpisodeTableSeeder extends Seeder {

	const MAX = 10;
	
	public function run()
    {
		$f = F::create();
        DB::table('episodes')->delete();
		DB::table('shows')->delete();
		
		for ($i=0;$i<self::MAX;$i++) {
			$show = Show::create(array(
				'title' => $f->name,
				'description' => $f->name
			));
			for ($i=0;$i<self::MAX;$i++) {
				$episode = Episode::create(array(
					'title' => $f->name,
					'description' => $f->name,
					'show_id' => $show->id
				));
			}
		}
		
		for ($i=0;$i<self::MAX;$i++) {
			Episode::create(array(
				'title' => $f->name,
				'description' => $f->name
			));
		}
    }

}
