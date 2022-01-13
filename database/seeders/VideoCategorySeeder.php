<?php

namespace Database\Seeders;

use App\Models\VideoCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table video_categories NOCHECK Constraint All');
        \DB::table('video_categories')->truncate();
        \DB::table('video_categories')->insert([
            [ 'title' => 'ทั่วไป', 'published' => true ],
            [ 'title' => 'x', 'published' => true ],
            [ 'title' => 'x', 'published' => true ],
            [ 'title' => 'สื่อวิดีทัศน์', 'published' => true ],
            [ 'title' => 'สื่อความบันเทิง', 'published' => true ],
            [ 'title' => 'ข่าว', 'published' => true ],
        ]);

        VideoCategory::where('title', 'x')->delete();
    
    }
}
