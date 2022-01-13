<?php

namespace App\Observers;

use App\Enums\MenuTypeEnum;
use App\Models\Content;
use App\Models\Menu;

class ContentObserver
{

    public function created(Content $content)
    {
        $contentType = $content->type;

        $menu = Menu::where('title', $content->title)->first();

        if (!$menu) {
            Menu::create([
                'title' => $content->title,
                'parent_id' => $contentType->id,
                'menu_type_id' => MenuTypeEnum::CONTENT,
                'content_id' => $content->id,
                'published' => false,
                'menu_position' => 'top_menu'
            ]);
        }
    }

    public function deleting(Content $content)
    {
        $menu = Menu::where('content_id', $content->id)->first();
        if ($menu) {
            $menu->menu_type_id = MenuTypeEnum::BLANK;
            $menu->content_id = null;
            $menu->published = false;
            $menu->save();
        }
    }
}
