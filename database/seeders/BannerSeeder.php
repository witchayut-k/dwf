<?php

namespace Database\Seeders;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = Banner::where('migrate_image_url', '!=', null)->get();
        foreach ($banners as $banner) {
            try {
                $banner->clearMediaCollection('featured_image');
                $banner->addMediaFromUrl("https://www.dwf.go.th/assets/img/sliders/" . urlencode($banner->migrate_image_url))
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            } catch (\Exception $e) {
            }
        }

        // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \DB::statement('Alter Table banners NOCHECK Constraint All');
        // \DB::table('banners')->truncate();
        // $faker = Faker::create();
        // for ($i = 0; $i < 10; $i++) {
        //     \DB::table('banners')->insert(array(
        //         [
        //             'title' => $faker->name,
        //             'sequence' => $i,
        //             'published' => true,
        //             'created_at' => Carbon::now()
        //         ]
        //     ));
        // }
    }
}
