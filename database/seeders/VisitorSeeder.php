<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visitor::where('ip', 'generator')->delete();
        // for ($i = 0; $i <= 30000; $i++) {

        //     Visitor::create([
        //         'date' => date('Y-m-d', strtotime( '-'.mt_rand(15, 45).' days')),
        //         'ip' => 'generator',
        //     ]);
        // }
    }
}
