<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外鍵約束
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 啟用外鍵約束

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

        DB::table('users')->insert([
            'name' => 'meso',
            'account' => 'meso',
            'email'    => 'bocheng4o7@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '0'
        ]);

        DB::table('users')->insert([
            'name' => 'gary',
            'account' => 'gary',
            'email'    => 'bocheng4o7@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '0'
        ]);

        DB::table('users')->insert([
            'name' => 'mandy',
            'account' => 'mandy',
            'email'    => 'mandy@gmail.com',
            'password' => Hash::make('123456'),
            'isAdmin' => '1'
        ]);
    }
}