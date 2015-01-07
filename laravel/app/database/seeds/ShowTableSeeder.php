<?php

use Faker\Factory as F;

class ShowTableSeeder extends Seeder {

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
			for ($j=0;$j<self::MAX;$j++) {
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
