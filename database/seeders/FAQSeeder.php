<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::statement('Alter Table faqs NOCHECK Constraint All');
        \DB::table('faqs')->truncate();
        \DB::table('faqs')->insert(array(
            [
                'title' => $faker->name,
                'content' => $faker->text,
                'published' => true
            ],

            [
                'title' => $faker->name,
                'content' => $faker->text,
                'published' => true
            ],

            [
                'title' => $faker->name,
                'content' => $faker->text,
                'published' => true
            ],
        ));
    }
}
