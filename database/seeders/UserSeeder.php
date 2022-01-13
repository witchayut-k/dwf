<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \DB::statement('Alter Table users NOCHECK Constraint All');
        // \DB::table('users')->truncate();
        \DB::table('users')->insert(array(
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => $faker->email,
                'email_verified_at' => Carbon::now(),
                'password' => '$2y$10$HcfqrmyMC07hGjmEsTWqZeiCLbTTPw/V8YIBuT1NW5nDvlze4Ssp.',
                'enabled' => TRUE,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ));
    }
}
