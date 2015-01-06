<?php

use Faker\Factory as F;

class CardTableSeeder extends Seeder {

	const MAX = 100;
	
	public function run()
    {
		$f = F::create();
        DB::table('cards')->delete();
		for ($i=0;$i<self::MAX;$i++) {
			Card::create(array(
				'front' => $f->name
			));
		}
    }

}
