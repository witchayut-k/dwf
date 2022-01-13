<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table content_types NOCHECK Constraint All');
        \DB::table('content_types')->truncate();
        \DB::table('content_types')->insert([
            ['name' => 'ข้อมูลทั่วไป', 'published' => true],
            ['name' => 'ข่าว', 'published' => true],
            ['name' => 'ประชาสัมพันธ์', 'published' => true],
            ['name' => 'ประกาศ', 'published' => true],
            ['name' => 'เกี่ยวกับ สค.', 'published' => true],
            ['name' => 'กิจกรรมผู้บริหาร', 'published' => true],
            ['name' => 'จัดซื้อจัดจ้าง', 'published' => true],
            ['name' => 'ปฏิทินกิจกรรม', 'published' => true],
            ['name' => 'ติดต่อ สค.', 'published' => true],
            ['name' => 'ป๊อปอัพ', 'published' => true],
            ['name' => 'ประกาศราคากลาง', 'published' => true],
            ['name' => 'สรุปผลการจัดซื้อจัดจ้าง', 'published' => true],
            ['name' => 'รับสมัครงาน', 'published' => true],
            ['name' => 'ข้อมูลซีไอโอ', 'published' => true],
            ['name' => 'ข่าวสารจากซีไอโอ', 'published' => true],
            ['name' => 'กฏ/ระเบียบ/ข้อบังคับ', 'published' => true],
            ['name' => 'ศูนย์ข้อมูลข่าวสาร', 'published' => true],
            ['name' => 'ข้อมูลด้านสตรี', 'published' => true],
            ['name' => 'ข้อมูลด้านครอบครัว', 'published' => true],
            ['name' => 'แผนงาน โครงการ และงบประมาณรายจ่ายประจำปี', 'published' => true],
            ['name' => 'แนวทางพิจารณาโครงการขอรับเงินอุดหนุน สค.', 'published' => true],
            ['name' => 'แผน/นโยบาย/ระเบียบ/คำสั่ง ที่เกี่ยวข้อง', 'published' => true],
            ['name' => 'สมัชชาสตรีและครอบครัว', 'published' => true],
            ['name' => 'ผู้บริหารเทคโนโลยีสารสนเทศระดับสูง (DCIO)', 'published' => true],
            ['name' => 'กฏหมาย/ระเบียบ/ข้อบังคับ', 'published' => true],
            ['name' => 'นิยามศัพท์ ', 'published' => true],
            ['name' => 'หนังสือรับรองการขัดกัน', 'published' => true],
            ['name' => 'พม.Connect', 'published' => true],
            ['name' => 'งานคุ้มครองจริยธรรม', 'published' => true],
            ['name' => 'แผนการจัดซื้อจัดจ้าง', 'published' => true],
            ['name' => 'การเปิดโอกาสให้เกิดการมีส่วนร่วม', 'published' => true],
            ['name' => 'ร้องทุกข์ ร้องเรียน', 'published' => true],
            ['name' => 'ขายทอดตลาด', 'published' => true],
            ['name' => 'คู่มือ มาตรฐาน (การปฏิบัติงาน/การให้บริการ)', 'published' => true],
            ['name' => 'แผน-ผล', 'published' => true],
            ['name' => 'จริยธรรมและป้องกันการทุจริต', 'published' => true],
            ['name' => 'การบริหารและพัฒนาทรัพยากรบุคคล', 'published' => true],
        ]);
    }
}
