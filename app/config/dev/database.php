<?php

return array(
	'default' => 'main',
	'connections' =>
		array(
			'main' => array(
				'driver'    => 'mysql',
				'host'      => '127.0.0.1:3307',
				'database'  => 'quizlet_dev',
				'username'  => 'root',
				'password'  => $_ENV['dbpass'],
				'charset'   => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'    => '',
			)
		)
);
