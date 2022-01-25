<?php

namespace Database\Seeders;

use App\Enums\MenuTypeEnum;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class FooterMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Footer Menu

        Menu::where('menu_position', 'footer_menu')->delete();

        $menuFooterOther = Menu::create(['title' => 'อื่นๆ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);
        $menuFooterAnnounce = Menu::create(['title' => 'ข่าวประชาสัมพันธ์', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);
        $menuFooterInfo = Menu::create(['title' => 'ข้อมูลอื่นๆ', 'parent_id' => null, 'menu_type_id' => MenuTypeEnum::BLANK, 'menu_position' => 'footer_menu']);

        // อื่นๆ
        \DB::table('menus')->insert([
            ['title' => 'คำถามที่พบบ่อย', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::INTERNALLINK, 'url' => 'faq', 'menu_position' => 'footer_menu'],
        ]);
        \DB::table('menus')->insert([
            ['title' => 'ข้อตกลงการให้บริการ', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 1106, 'menu_position' => 'footer_menu'],
            ['title' => 'นโยบายความเป็นส่วนตัว', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 1108, 'menu_position' => 'footer_menu'],
        ]);
        \DB::table('menus')->insert([
            ['title' => 'แผนผังเว็บไซต์', 'parent_id' => $menuFooterOther->id, 'menu_type_id' => MenuTypeEnum::INTERNALLINK, 'url' => 'sitemap', 'menu_position' => 'footer_menu'],

        ]);

        // ข่าวประชาสัมพันธ์
        \DB::table('menus')->insert([
            ['title' => 'ข่าวประชาสัมพันธ์', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT_CATEGORY, 'content_id' => 3, 'menu_position' => 'footer_menu'],
            ['title' => 'ประกาศรับสมัครงาน', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT_CATEGORY, 'content_id' => 13, 'menu_position' => 'footer_menu'],
            ['title' => 'จัดซื้อจัดจ้าง', 'parent_id' => $menuFooterAnnounce->id, 'menu_type_id' => MenuTypeEnum::CONTENT_CATEGORY, 'content_id' => 7, 'menu_position' => 'footer_menu'],
        ]);

        // ข้อมูลอื่นๆ
        \DB::table('menus')->insert([
            ['title' => 'ประวัติความเป็นมา', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 107, 'menu_position' => 'footer_menu'],
            ['title' => 'วิสัยทัศน์ พันธกิจหลัก', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 131, 'menu_position' => 'footer_menu'],
            ['title' => 'ภารกิจหน้าที่', 'parent_id' => $menuFooterInfo->id, 'menu_type_id' => MenuTypeEnum::CONTENT, 'content_id' => 151, 'menu_position' => 'footer_menu'],
        ]);
    }
}
