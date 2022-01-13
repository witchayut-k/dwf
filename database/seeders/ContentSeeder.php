<?php

namespace Database\Seeders;

use App\Enums\ContentTypeEnum;
use App\Models\Content;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('contents')->truncate();

        // $sql = file_get_contents(database_path() . '/seeders/sql/contents.sql');
        // \DB::unprepared($sql);

        // $contents = Content::where('old_image_url', '!=', null)->get();
        // foreach ($contents as $content) {
        //     if (!$content->has_featured_image) {
        //         try {
        //             $content->clearMediaCollection('featured_image');
        //             $content->addMediaFromUrl("https://www.dwf.go.th/uploads/contents/".urlencode($content->old_image_url))
        //                 ->preservingOriginal()
        //                 ->toMediaCollection('featured_image');
        //         } catch (\Exception $e) {

        //         }
        //     }
        // }
        // \DB::statement('Alter Table contents NOCHECK Constraint All');
        // \DB::table('contents')->truncate();

        //$user = User::find(1);
        //Auth::login($user);

        // เกี่ยวกับ ส.ค.
        //Content::create(['title' => 'ประวัติความเป็นมา', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true]);
        // \DB::table('contents')->insert(
        //     [
        //         ['title' => 'ประวัติความเป็นมา', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ค่านิยม วิสัยทัศน์ พันธกิจ วัฒนธรรมองค์กร', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ภารกิจ หน้าที่และอำนาจ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'โครงสร้างหน่วยงาน', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'ผู้บริหาร สค.', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ทำเนียบกรม', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ทำเนียบผู้อำนวยการ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ผู้บริหารฝ่ายการเมือง พม.', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ผู้บริหารฝ่ายข้าราชการประจำ พม.', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'ผู้บริหารเทคโนโลยีสารสนเทศระดับสูง (DCIO)', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'พันธกิจด้านเทคโนโลยีสารสนเทศและการสื่อสาร', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'วิสัยทัศน์และนโยบายต่างๆ ด้าน ICT', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'การบริหารงานด้าน ICT', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ข่าวสารจากซีไอโอ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ติดต่อ ซีไอโอ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ปฎิทินกิจกรรมซีไอโอ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'แผน/นโยบาย/ระเบียบ/คำสั่ง ที่เกี่ยวข้อง', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'การจัดการเรื่องร้องเรียนการทุจริต', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'การประเมินความเสี่ยงเพื่อการป้องกันการทุจริต', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'การเสริมสร้างวัฒนธรรมองค์กร', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'แผนปฏิบัติการป้องกันการทุจริต', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'มาตรการส่งเสริมความโปร่งใสและป้องกันการทุจริต', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'เจตนารมณ์ของผู้บริหาร', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'การบริหารและพัฒนาทรัพยากรบุคคล', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'แผนการประเมินคุณธรรมและความโปร่งใสฯ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'ผลการประเมินคุณธรรมและความโปร่งใสฯ', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],

        //         ['title' => 'นโยบายการบริหารทรัพยากรบุคคล', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'การดำเนินการตามนโยบายการบริหารทรัพยากรบุคคล', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'หลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //         ['title' => 'รายงานผลการบริหารและพัฒนาทรัพยากรบุคคล', 'content_type_id' => ContentTypeEnum::ABOUT, 'published' => true, 'created_by' => 1, 'created_at' => Carbon::now()],
        //     ]
        // );

        // ประชาสัมพันธ์
        // \DB::table('contents')->insert(
        //     [
        //         ['title' => 'ประวัติความเป็นมา', 'content_type_id' => ContentTypeEnum::ANNOUNCE, 'published' => true, 'created_by' => 1 ],

        //         ['title' => '', 'content_type_id' => ContentTypeEnum::ANNOUNCE, 'published' => true, 'created_by' => 1 ],
        //     ]
        // );

        // ข่าวประชาสัมพันธ์
        // $faker = Faker::create();
        // for ($i = 0; $i < 100; $i++) {
        //     $int = mt_rand(1262055681, 1262055681);
        //     $date = date("Y-m-d H:i:s", $int);
        //     \DB::table('contents')->insert([
        //         ['title' => $faker->name, 'content_type_id' => ContentTypeEnum::NEWS, 'published' => true, 'created_at' => $date, 'created_by' => 1],
        //     ]);
        // }

        // กิจกรรม ส.ค.
        // $faker = Faker::create();
        // for ($i = 0; $i < 100; $i++) {
        //     $int = mt_rand(1262055681, 1262055681);
        //     $date = date("Y-m-d H:i:s", $int);
        //     \DB::table('contents')->insert([
        //         ['title' => $faker->name, 'content_type_id' => ContentTypeEnum::ACTIVITY, 'published' => true, 'created_at' => $date, 'created_by' => 1],
        //     ]);
        // }
    }
}
