<?php

use Illuminate\Database\Seeder;
use App\TaiwanMessage;

class TaiwanMessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // 禁用外鍵約束
        DB::table('taiwan_messages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // 啟用外鍵約束

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言1',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言2',
            'rating' => 4,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言3',
            'rating' => 4,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言4',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言5',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言6',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言7',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言8',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言9',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言10',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言11',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言12',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言13',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 1,
            'site_id' => 2,
            'content'    => '留言14',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '留言A',
            'rating' => 5,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '留言B',
            'rating' => 9,
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => 2,
            'site_id' => 2,
            'content'    => '留言C',
            'rating' => 8,
        ]);
    }
}
