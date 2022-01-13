<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::statement('Alter Table petitions NOCHECK Constraint All');
        \DB::table('petitions')->truncate();
        \DB::table('petitions')->insert(array(
            [
                'type_name' => $faker->name,
                'subject' => $faker->name,
                'detail' => $faker->text,

                'prefix' => '',
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'tel' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'province' => $faker->address,
                'amphur' => $faker->address(),
                'tambol' => $faker->address,
                'zipcode' => '11111',

                'created_at' => Carbon::now(),
            ],
        ));
    }
}
