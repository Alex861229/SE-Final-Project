<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::truncate();

        DB::table('users')->insert([
            'name' => 'cheng',
            'account' => 'cheng',
            'email'    => 'bocheng4o7@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '1'
        ]);

        DB::table('users')->insert([
            'name' => 'alex',
            'account' => 'alex',
            'email'    => 'bocheng4o7@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '0'
        ]);
    }
}