<?php

use Illuminate\Database\Seeder;
use App\TaiwanSite;

class TaiwanSiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外鍵約束
        DB::table('taiwan_site')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 啟用外鍵約束

        DB::table('taiwan_site')->insert([
            'name' => '台灣景點一',
            'description' => '台灣景點一介紹',
            'address' => '台灣景點一地址',
            'longitude' => 100.00000,
            'latitude' => 80.00000,
            'parkinginfo' => '台灣景點一停車場',
            'ticketinfo' => '台灣景點一售票資訊',
        ]);

        DB::table('taiwan_site')->insert([
            'name' => '台灣景點二',
            'description' => '台灣景點二介紹',
            'address' => '台灣景點二地址',
            'longitude' => 101.00000,
            'latitude' => 82.00000,
            'parkinginfo' => '台灣景點二停車場',
            'ticketinfo' => '台灣景點二售票資訊',
        ]);
    }
}
