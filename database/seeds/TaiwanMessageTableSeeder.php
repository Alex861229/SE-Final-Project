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
        DB::table('taiwan_messages')->truncate();

        DB::table('taiwan_messages')->insert([
            'user_id' => '1',
            'site_id' => '1',
            'content'    => '留言1',
            'rating' => '5',
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => '1',
            'site_id' => '1',
            'content'    => '留言2',
            'rating' => '9',
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => '1',
            'site_id' => '1',
            'content'    => '留言3',
            'rating' => '8',
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => '2',
            'site_id' => '1',
            'content'    => '留言A',
            'rating' => '5',
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => '2',
            'site_id' => '1',
            'content'    => '留言B',
            'rating' => '9',
        ]);

        DB::table('taiwan_messages')->insert([
            'user_id' => '2',
            'site_id' => '1',
            'content'    => '留言C',
            'rating' => '8',
        ]);
    }
}
