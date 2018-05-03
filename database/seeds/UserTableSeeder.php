<?php

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'sunny',
        'username' => 'sunny477',
        'email'    => 'sunnypatel477@gmail.com',
        'password' => Hash::make('sunny'),
    ));
}

}
