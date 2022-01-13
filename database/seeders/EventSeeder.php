<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::statement('Alter Table events NOCHECK Constraint All');
        \DB::table('events')->truncate();
        \DB::table('events')->insert(array(
            [
                'title' => $faker->name,
                'begin_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(3),
                'published' => true
            ],

            [
                'title' => $faker->name,
                'begin_date' => Carbon::now()->addDays(7),
                'end_date' => Carbon::now()->addDays(10),
                'published' => true
            ],

            [
                'title' => $faker->name,
                'begin_date' => Carbon::now()->addDays(15),
                'end_date' => Carbon::now()->addDays(15),
                'published' => true
            ],
        ));
    }
}
