<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::statement('Alter Table messages NOCHECK Constraint All');
        \DB::table('messages')->truncate();
        \DB::table('messages')->insert(array(
            [
                'subject' => $faker->name,
                'sender_email' => $faker->email,
                'note' => $faker->text,
                'created_at' => Carbon::now(),
            ],

            [
                'subject' => $faker->name,
                'sender_email' => $faker->email,
                'note' => $faker->text,
                'created_at' => Carbon::now()->addDays(7),
            ],

            [
                'subject' => $faker->name,
                'sender_email' => $faker->email,
                'note' => $faker->text,
                'created_at' => Carbon::now()->addDays(15),
            ],
        ));
    }
}
