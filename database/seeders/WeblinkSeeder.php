<?php

namespace Database\Seeders;

use App\Enums\WeblinkTypeEnum;
use App\Models\Weblink;
use Illuminate\Database\Seeder;

class WeblinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table weblinks NOCHECK Constraint All');
        \DB::table('weblinks')->truncate();

        \DB::table('weblinks')->insert(
            [
                ['title' => 'Digital Literacy', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'มาตราฐานข้อมูลกระทรวง', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'ระบบแผนที่ทางสังคม', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'ระบบใบสมัครออนไลน์ของศูนย์เรียนรู้', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'ลองเรียนลองรู้', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'ระบบติดตามการใช้บริการพม.', 'weblink_type_id' => 6, 'url' => 'https://dwf.go.th/', 'published' => true],
            ]
        );

        // Social Network
        \DB::table('weblinks')->insert(
            [
                ['title' => 'จุติ ไกรฤกษ์', 'subtitle' => 'รมว.พัฒนาสังคมฯ', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'Facebook กระทรวง พม.', 'subtitle' => 'กระทรวงพม.', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'Facebook ส.ค.', 'subtitle' => 'กรมกิจการสตรีและครอบครัว', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'PMOC', 'subtitle' => 'ศูนย์ปฏิบัติการนายกรัฐมนตรี', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'ไทยคู่ฟ้า', 'subtitle' => '@ThaigovSpokesman', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'Anti-Fake News', 'subtitle' => 'Center thailand', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'คลังข้อมูลสารสนเทศ', 'subtitle' => 'กรมกิจการสตรีและสถาบันครอบครัว', 'weblink_type_id' => 10, 'url' => 'https://dwf.go.th/', 'published' => true],
            ]
        );

        // หน่วยงาน พม
        \DB::table('weblinks')->insert(
            [
                ['title' => 'กรมกิจการเด็กและเยาวชน', 'weblink_type_id' => 12, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สถาบันพัฒนาองค์กรชุมชน (องค์การมหาชน)', 'weblink_type_id' => 12, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สำนักงานธนานุเคราะห์', 'weblink_type_id' => 12, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'การเคหะแห่งชาติ', 'weblink_type_id' => 12, 'url' => 'https://dwf.go.th/', 'published' => true],
            ]
        );

        // สำหรับข้าราชการ
        \DB::table('weblinks')->insert(
            [
                ['title' => 'ระบบอินทราเน็ต', 'weblink_type_id' => 16, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'อีเมลกลางภาครัฐ', 'weblink_type_id' => 16, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'รวมลิงก์ระบบสารสนเทศกระทรวง', 'weblink_type_id' => 16, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สหกรณ์ออมทรัพย์กระทรวง', 'weblink_type_id' => 16, 'url' => 'https://dwf.go.th/', 'published' => true],
            ]
        );

        $weblinks = Weblink::all();
        foreach ($weblinks as $key => $weblink) {
            $id = $key + 1;
            try {
                $weblink->clearMediaCollection('featured_image');
                $weblink->addMedia(public_path("img/weblink/$id.png"))
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            } catch (\Exception $e) {
            }
        }

        // หน่วยงานส่วนภูมิภาค
        \DB::table('weblinks')->insert(
            [
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
                ['title' => 'สค. เข้าร่วมการประชุมคณะกรรมการด้านส่งเสริมคุณธรรม จริยธรรม สำหรับเยาวชน ครั้งที่ 1/2564', 'weblink_type_id' => 11, 'url' => 'https://dwf.go.th/', 'published' => true],
            ]
        );
    }
}
