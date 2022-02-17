<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /**
         * Required
         */
        // $this->call(UserSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(MenuSeeder::class);
        $this->call(ContentTypeSeeder::class);
        $this->call(WeblinkTypeSeeder::class);

        /**
         * Dummy
         */
        // $this->call(BannerSeeder::class);
        // $this->call(EventSeeder::class);
        $this->call(WeblinkSeeder::class);
        // $this->call(ContentSeeder::class);
        // $this->call(VideoCategorySeeder::class);
        // $this->call(VideoSeeder::class);
        // $this->call(FAQSeeder::class);
    }
}
