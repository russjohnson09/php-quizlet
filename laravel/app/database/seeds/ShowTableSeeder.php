<?php

use Faker\Factory as F;

class ShowTableSeeder extends Seeder {

	const MAX = 10;
	
	public function run()
    {
		$f = F::create();
        DB::table('episodes')->delete();
		DB::table('shows')->delete();
		DB::table('genres')->delete();
		
		$genres = array();
		
		for ($i=0;$i<self::MAX;$i++) {
			$genres[] = Genre::create(array(
				'description' => $f->name
			));
		}
		
		for ($i=0;$i<self::MAX;$i++) {
			$show = Show::create(array(
				'title' => $f->name,
				'description' => $f->name
			));
			$show->genres()->save($genres[$i]);
			if ($i%2) $show->genres()->save($genres[0]);
			for ($j=0;$j<self::MAX;$j++) {
				$episode = Episode::create(array(
					'title' => $f->name,
					'description' => $f->name,
					'show_id' => $show->id
				));
			}
		}
		//$show->saveMany(array($genres[0],$genres[3]));
		
		for ($i=0;$i<self::MAX;$i++) {
			Episode::create(array(
				'title' => $f->name,
				'description' => $f->name
			));
		}
    }

}
