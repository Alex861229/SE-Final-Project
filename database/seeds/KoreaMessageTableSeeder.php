<?php

use Illuminate\Database\Seeder;
use App\KoreaMessage;

class KoreaMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外鍵約束
        DB::table('korea_messages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 啟用外鍵約束

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言1',
            'rating' => 5,

        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言2',
            'rating' => 4,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言3',
            'rating' => 4,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言4',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言5',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言6',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言7',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言8',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言9',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言10',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言11',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '韓國留言12',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '韓國留言A',
            'rating' => 5,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '韓國留言B',
            'rating' => 9,
        ]);

        DB::table('korea_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '韓國留言C',
            'rating' => 8,
        ]);
    }
}
