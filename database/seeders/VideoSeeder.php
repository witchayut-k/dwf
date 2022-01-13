<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table videos NOCHECK Constraint All');
        \DB::table('videos')->truncate();

        $sql = file_get_contents(database_path() . '/seeders/sql/videos.sql');
        \DB::unprepared($sql);
      
        // $faker = Faker::create();
        // for ($i = 0; $i < 100; $i++) {
        //     $int = mt_rand(1262055681, 1262055681);
        //     $date = date("Y-m-d H:i:s", $int);
        //     \DB::table('videos')->insert([
        //         ['title' => $faker->name, 'video_category_id' => 1, 'published' => true, 'created_at' => $date, 'created_by' => 1],
        //     ]);
        // }
    }
}