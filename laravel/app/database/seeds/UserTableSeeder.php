<?php
 
class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
 
        User::create(array(
            'username' => 'guest',
            'password' => Hash::make('guest')
        ));
 
        User::create(array(
            'username' => 'russ',
            'password' => Hash::make('russ')
        ));
    }
 
}