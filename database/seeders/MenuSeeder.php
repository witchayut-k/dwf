<?php

namespace Database\Seeders;

use App\Enums\MenuTypeEnum;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /*
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        return;
        
        \DB::statement('Alter Table menus NOCHECK Constraint All');
        \DB::table('menus')->truncate();

        // Top Menu

        $menuAbout = Menu::create(['title' => 'เกี่ยวกับ ส.ค.', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>1]);
        $menuAnnounce = Menu::create(['title' => 'ประชาสัมพันธ์', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>2]);
        $menuService = Menu::create(['title' => 'บริการ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>3]);
        $menuKM = Menu::create(['title' => 'คลังความรู้', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>4]);
        $menuSystem = Menu::create(['title' => 'ระบบงาน ส.ค.', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>5]);
        $menuStat = Menu::create(['title' => 'ข้อมูลสถิติ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>6]);
        $menuPlan = Menu::create(['title' => 'แผน-ผล', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>7]);
        $menuContact = Menu::create(['title' => 'ติดต่อ สค.', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'top_menu', 'sequence'=>8]);

        // return ;

        \DB::table('menus')->insert([
            ['title' => 'ประวัติความเป็นมา', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 1, 'menu_position' => 'top_menu'],
            ['title' => 'ค่านิยม วิสัยทัศน์ พันธกิจ วัฒนธรรมองค์กร', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 2, 'menu_position' => 'top_menu'],
            ['title' => 'ภารกิจ หน้าที่และอำนาจ', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 3, 'menu_position' => 'top_menu'],
            ['title' => 'โครงสร้างหน่วยงาน', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 4, 'menu_position' => 'top_menu'],
        ]);

        $subMenuBoard = Menu::create(['title' => 'ผู้บริหาร', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'ผู้บริหาร สค.', 'parent_id' => $subMenuBoard->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 5, 'menu_position' => 'top_menu'],
            ['title' => 'ทำเนียบกรม', 'parent_id' => $subMenuBoard->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 6, 'menu_position' => 'top_menu'],
            ['title' => 'ทำเนียบผู้อำนวยการ', 'parent_id' => $subMenuBoard->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 7, 'menu_position' => 'top_menu'],
            ['title' => 'ผู้บริหารฝ่ายการเมือง พม.', 'parent_id' => $subMenuBoard->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 8, 'menu_position' => 'top_menu'],
            ['title' => 'ผู้บริหารฝ่ายข้าราชการประจำ พม.', 'parent_id' => $subMenuBoard->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 9, 'menu_position' => 'top_menu'],
        ]);

        $subMenuCIO = Menu::create(['title' => 'ข้อมูลซีไอโอ', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'ผู้บริหารเทคโนโลยีสารสนเทศระดับสูง (DCIO)', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 10, 'menu_position' => 'top_menu'],
            ['title' => 'ผู้บริหารเทคโนโลยีสารสนเทศระดับสูง (DCIO)', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 11, 'menu_position' => 'top_menu'],
            ['title' => 'พันธกิจด้านเทคโนโลยีสารสนเทศและการสื่อสาร', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 12, 'menu_position' => 'top_menu'],
            ['title' => 'วิสัยทัศน์และนโยบายต่างๆ ด้าน ICT', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 13, 'menu_position' => 'top_menu'],
            ['title' => 'การบริหารงานด้าน ICT', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 14, 'menu_position' => 'top_menu'],
            ['title' => 'ข่าวสารจากซีไอโอ', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 15, 'menu_position' => 'top_menu'],
            ['title' => 'ติดต่อ ซีไอโอ', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 16, 'menu_position' => 'top_menu'],
            ['title' => 'ปฎิทินกิจกรรมซีไอโอ', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 17, 'menu_position' => 'top_menu'],
            ['title' => 'แผน/นโยบาย/ระเบียบ/คำสั่ง ที่เกี่ยวข้อง', 'parent_id' => $subMenuCIO->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 18, 'menu_position' => 'top_menu'],

        ]);

        $subMenuCorrupt = Menu::create(['title' => 'จริยธรรมและป้องกันการทุจริต', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'การจัดการเรื่องร้องเรียนการทุจริต', 'parent_id' => $subMenuCorrupt->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 20, 'menu_position' => 'top_menu'],
            ['title' => 'การประเมินความเสี่ยงเพื่อการป้องกันการทุจริต', 'parent_id' => $subMenuCorrupt->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 21, 'menu_position' => 'top_menu'],
            ['title' => 'การเสริมสร้างวัฒนธรรมองค์กร', 'parent_id' => $subMenuCorrupt->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 22, 'menu_position' => 'top_menu'],
            ['title' => 'แผนปฏิบัติการป้องกันการทุจริต', 'parent_id' => $subMenuCorrupt->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 23, 'menu_position' => 'top_menu'],
            ['title' => 'มาตรการส่งเสริมความโปร่งใสและป้องกันการทุจริต', 'parent_id' => $subMenuCorrupt->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 24, 'menu_position' => 'top_menu'],

            ['title' => 'เจตนารมณ์ของผู้บริหาร', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 25, 'menu_position' => 'top_menu'],
            ['title' => 'การบริหารและพัฒนาทรัพยากรบุคคล', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 26, 'menu_position' => 'top_menu'],

        ]);

        $subMenuITA = Menu::create(['title' => 'คุณธรรมและความโปร่งใส (ITA)', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'แผนการประเมินคุณธรรมและความโปร่งใสฯ', 'parent_id' => $subMenuITA->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],
            ['title' => 'ผลการประเมินคุณธรรมและความโปร่งใสฯ', 'parent_id' => $subMenuITA->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],

        ]);

        $subMenuHR = Menu::create(['title' => 'การบริหารและพัฒนาทรัพยากรบุคคล', 'parent_id' => $menuAbout->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'นโยบายการบริหารทรัพยากรบุคคล', 'parent_id' => $subMenuHR->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],
            ['title' => 'การดำเนินการตามนโยบายการบริหารทรัพยากรบุคคล', 'parent_id' => $subMenuHR->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],
            ['title' => 'หลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล', 'parent_id' => $subMenuHR->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],
            ['title' => 'รายงานผลการบริหารและพัฒนาทรัพยากรบุคคล', 'parent_id' => $subMenuHR->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => NULL, 'menu_position' => 'top_menu'],
        ]);

        // ประชาสัมพันธ์

        Menu::create(['title' => 'ข่าวประชาสัมพันธ์', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT_CATEGORY, 'content_id' => 3, 'menu_position' => 'top_menu']);
        $subMenuFeed = Menu::create(['title' => 'ประกาศ', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'จัดซื้อจัดจ้าง', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ประกาศราคากลาง', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สรุปผลการจัดซื้อจัดจ้าง', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'รับสมัครงาน', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'หนังสือรับรองการขัดกัน', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แผนการจัดซื้อจัดจ้าง', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ขายทอดตลาด', 'parent_id' => $subMenuFeed->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        \DB::table('menus')->insert([
            ['title' => 'พม.Connect', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 0, 'menu_position' => 'top_menu'],
            ['title' => 'การเปิดโอกาสให้เกิดการมีส่วนร่วม', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 0, 'menu_position' => 'top_menu'],
            ['title' => 'ศูนย์ข้อมูลข่าวสาร', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 0, 'menu_position' => 'top_menu'],
            ['title' => 'คู่มือการขอรับเงินสนับสนุนจากกองทุนส่งเสริมความเท่าเทียมระหว่างเพศ', 'parent_id' => $menuAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 0, 'menu_position' => 'top_menu'],
        ]);

        // บริการ

        $subMenuAppeal = Menu::create(['title' => 'การร้องทุกข์ ร้องเรียน', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'ร้องทุกข์ ร้องเรียน', 'parent_id' => $subMenuAppeal->id, 'menu_type_id' => MenuTypeEnum::WEBLINK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'รายงานการจัดการข้อร้องเรียนฯ', 'parent_id' => $subMenuAppeal->id, 'menu_type_id' => MenuTypeEnum::WEBLINK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        \DB::table('menus')->insert([
            ['title' => 'ถาม - ตอบ', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'คำถามที่พบบ่อย', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ช่องทางรับฟังความคิดเห็น', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']
        ]);

        $subMenuRegister = Menu::create(['title' => 'ลงทะเบียนออนไลน์', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => NULL, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'ลงทะเบียนสัมมนาออนไลน์', 'parent_id' => $subMenuRegister->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']
        ]);

        \DB::table('menus')->insert([
            ['title' => 'สมัครสมาชิก', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แนะนำการใช้งาน', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'RSS Feed', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ใบสมัครเข้ารับการฝึกอบรมอาชีพในสถาบัน สำหรับศูนย์เรียนรู้ฯ', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']
        ]);

        // คลังความรู้

        $subMenuLaw = Menu::create(['title' => 'กฏหมาย/ระเบียบ/ข้อบังคับ', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'กฎหมายว่าด้วยการป้องกันและปราบปรามค้าประเวณี', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'กฎหมายว่าด้วยการฌาปนกิจสงเคราะห์', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'กฎหมายว่าด้วยการคุ้มครองผู้ถูกกระทำด้วยความรุนแรงในครอบครัว', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'กฎหมายว่าด้วยความเท่าเทียมระหว่างเพศ', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'กฎหมายว่าด้วยการส่งเสริมการพัฒนาและคุ้มครองสถาบันครอบครัว', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'พ.ร.ก.แก้ไขเพิ่มเติม พ.ร.บ.ส่งเสริมการพัฒนาและคุ้มครองสถาบันครอบครัวฯ', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระเบียบสำนักนายกรัฐมนตรี (สตรี)', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระเบียบสำนักนายกรัฐมนตรี (สถาบันครอบครัว)', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระเบียบกรมกิจการสตรีและสถาบันครอบครัว', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'กฎหมายว่าด้วยคำนำหน้านามหญิง', 'parent_id' => $subMenuLaw->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        $subMenuManual = Menu::create(['title' => 'คู่มือ มาตรฐาน', 'parent_id' => $menuService->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'คู่มือ มาตรฐาน การปฏิบัติงาน', 'parent_id' => $subMenuManual->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'คู่มือ มาตรฐาน การให้บริการ', 'parent_id' => $subMenuManual->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        \DB::table('menus')->insert([
            ['title' => 'ลองเรียน ลองรู้ สร้างอาชีพ', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'นิยามศัพท์', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ดาวน์โหลดแบบฟอร์ม', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แนวทางพิจารณาโครงการขอรับเงินอุดหนุน สค.', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ข้อมูลด้านสตรี', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ข้อมูลด้านครอบครัว', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบบริหารจัดการองค์ความรู้ (KM)', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'เครือข่ายหญิงไทยในต่างประเทศ', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แหล่งเรียนรู้ด้านเทคโนโลยีสารสนเทศของ พม.', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ศูนย์ข้อมูลกลางด้านความเสมอภาคหญิงชาย', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'งานวิจัย สค.', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'องค์กรคุณธรรมและความโปร่งใส', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สมัชชาสตรีและครอบครัว', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'คลังข้อมูลสารสนเทศ', 'parent_id' => $menuKM->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        // ระบบงาน ส.ค.
        \DB::table('menus')->insert([
            ['title' => 'ระบบอินทราเน็ต', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบจดหมายอิเล็กทรอนิกส์', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบศูนย์ปฏิบัติการ สค.', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบประชุมทางไกล', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ตรวจสอบภายใน', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบ DPIS', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สำหรับผู้นำเข้าข้อมูลเว็บไซต์', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'เว็บไซต์ สค. เดิม', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบ E-learning ความรุนแรงในครอบครัว และจัดการบัญหา', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบจัดการเว็บไซต์ สำหรับศูนย์เรียนรู้ฯ', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบฐานข้อมูลผู้รับบริการและผู้ประสบปัญหาทางสังคม สค. (เก่า)', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ใบสมัครเข้ารับการฝึกอบรมอาชีพในสถาบัน สำหรับศูนย์เรียนรู้ฯ (เก่า)', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ศูนย์ข้อมูลความรุนแรงต่อเด็ก สตรีและความรุนแรงในครอบครัว', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบแผนงานโครงการและติดตามผล', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ระบบงานสารบรรณอิเล็กทรอนิกส์', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'มาตรฐานครอบครัวเข้มแข็ง', 'parent_id' => $menuSystem->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        // ข้อมูลสถิติ
        \DB::table('menus')->insert([
            ['title' => 'สถานการณ์ความรุนแรงต่อเด็ก สตรีและความรุนแรงในครอบครัว', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สถานการณ์ ครอบครัวเข้มแข็ง', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สถานการณ์ หญิงชาย', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ข้อมูลด้านการฌาปนกิจสงเคราะห์', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สถานการณ์สตรีและครอบครัว', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ข้อมูลสถิติการให้บริการ', 'parent_id' => $menuStat->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        // แผน-ผล

        \DB::table('menus')->insert([
            ['title' => 'ยุทธศาสตร์', 'parent_id' => $menuPlan->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'Aแผนการดำเนินงาน', 'parent_id' => $menuPlan->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แผนการใช้จ่ายงบประมาณประจำปี', 'parent_id' => $menuPlan->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'คำรับรองและรายงานผลการปฎิบัติราชการ', 'parent_id' => $menuPlan->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'รายงานผลการสำรวจความพึงพอใจการให้บริการ', 'parent_id' => $menuPlan->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        // ติดต่อ สค.

        \DB::table('menus')->insert([
            ['title' => 'ติดต่อ สค. (ส่วนกลาง)', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ติดต่อ สค. (ส่วนภูมิภาค)', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'แผนผังเว็บไซต์', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'สำหรับเจ้าหน้าที่', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'ป๊อปอัพ', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        $subMenuInfo = Menu::create(['title' => 'ข้อมูลทั่วไป', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu']);
        \DB::table('menus')->insert([
            ['title' => 'ข้อตกลงการให้บริการ', 'parent_id' => $subMenuInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
            ['title' => 'นโยบายความเป็นส่วนตัว', 'parent_id' => $subMenuInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        \DB::table('menus')->insert([
            ['title' => 'Social Network', 'parent_id' => $menuContact->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'top_menu'],
        ]);

        // Footer Menu

        $menuFooterOther = Menu::create(['title' => 'อื่นๆ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);
        $menuFooterAnnounce = Menu::create(['title' => 'ข่าวประชาสัมพันธ์', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);
        $menuFooterInfo = Menu::create(['title' => 'ข้อมูลอื่นๆ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);

        // อื่นๆ
        \DB::table('menus')->insert([
            ['title' => 'คำถามที่พบบ่อย', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'ข้อตกลงการให้บริการ', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'นโยบายความเป็นส่วนตัว', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'แผนผังเว็บไซต์', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
        ]);

        // ข่าวประชาสัมพันธ์
        \DB::table('menus')->insert([
            ['title' => 'ข่าวประชาสัมพันธ์', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'ข่าวเด่นประจำวัน', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'ประกาศรับสมัครงาน', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'จัดซื้อจัดจ้าง', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
        ]);

        // ข้อมูลอื่นๆ
        \DB::table('menus')->insert([
            ['title' => 'เกี่ยวกับ สค.', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'ประวัติความเป็นมา', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'วิสัยทัศน์ พันธกิจหลัก', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
            ['title' => 'ภารกิจหน้าที่', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::BLANK, 'content_id' => null, 'menu_position' => 'footer_menu'],
        ]);

    }
}
