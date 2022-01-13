<?php

namespace Database\Seeders;

use App\Enums\WeblinkTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeblinkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table weblink_types NOCHECK Constraint All');
        \DB::table('weblink_types')->truncate();
        \DB::table('weblink_types')->insert([
            [
                'title' => 'Link บริการ สค',
                'example_image' => '../backend/img/weblinks/example01.jpg',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'title' => 'Social Network (บน)',
                'example_image' => '../backend/img/weblinks/example02.jpg',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'title' => 'หน่วยงานส่วนภูมิภาค',
                'example_image' => '../backend/img/weblinks/example03.jpg',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'title' => 'Link ที่เกี่ยวข้อง',
                'example_image' => '../backend/img/weblinks/example04.jpg',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
            [
                'title' => 'สำหรับข้าราชการ',
                'example_image' => '../backend/img/weblinks/example05.jpg',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1
            ],
        ]);

        \DB::table('weblink_types')->insert([
            [
                'title' => 'E-Service',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::SERVICE
            ],
            [
                'title' => 'E-Form',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::SERVICE
            ],
            [
                'title' => 'ร้องเรียน-ร้องทุกข์',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::SERVICE
            ],
            [
                'title' => 'ข้อคิดเห็นและข้อเสนอแนะ',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::SERVICE
            ],
        ]);

        \DB::table('weblink_types')->insert([
            [
                'title' => 'Social Network',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::SOCIAL_NETWORK_TOP
            ],
        ]);

        \DB::table('weblink_types')->insert([
            [
                'title' => 'หน่วยงานส่วนภูมิภาค',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::DEPARTMENT
            ],
        ]);

        \DB::table('weblink_types')->insert([
            [
                'title' => 'หน่วยงาน พม.',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::RELATED_LINK
            ],
            [
                'title' => 'หน่วยงานภายในกรม',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::RELATED_LINK
            ],
            [
                'title' => 'Social Network',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::RELATED_LINK
            ],
            [
                'title' => 'Link',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::RELATED_LINK
            ],
        ]);

        \DB::table('weblink_types')->insert([
            [
                'title' => 'สำหรับข้าราชการ',
                'published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'created_by' => 1,
                'parent_type_id' => WeblinkTypeEnum::GOV_LINK
            ],
        ]);
    }
}
