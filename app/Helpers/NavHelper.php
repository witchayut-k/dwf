<?php

namespace App\Helpers;

use App\Enums\MenuTypeEnum;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\Menu;

class NavHelper
{
    public static function RenderTopMenu()
    {
        $root = "";

        $menu = Menu::ofPublished()->where('parent_id', null)->where('menu_position', 'top_menu')->orderBy('sequence')->get();

        foreach ($menu as $nav) {
            if (count($nav->published_children) == 0) {
                $root .= "<li class=\"nav-item\">
                                " . NavHelper::RenderMenuItem($nav, "nav-link") . "
                            </li>";
            } else {
                $root .= "<li class=\"nav-item dropdown\">" . NavHelper::RenderMenuItem($nav, "nav-link dropdown-toggle", 'id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"');

                $root .= "<ul class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">";

                foreach ($nav->published_children as $submenu) {
                    if (count($submenu->children) == 0) {
                        $root .= "<li>" . NavHelper::RenderMenuItem($submenu, "dropdown-item") . "</li>";
                    } else {
                        $submenu2 = "";

                        foreach ($submenu->published_children as $item) {
                            $submenu2 .= "<li>" . NavHelper::RenderMenuItem($item, "dropdown-item") . "</li>";
                        }

                        $root .= "<li class=\"dropdown-submenu\">";
                        $root .= NavHelper::RenderMenuItem($submenu, "dropdown-item dropdown-toggle");
                        $root .= "<ul class=\"dropdown-menu\">$submenu2</ul>";
                        $root .= "</li>";
                    }
                }

                $root .= "</ul>
                        </li>";
            }
        }

        return $root;
    }

    public static function RenderFooterMenu()
    {
        $root = "";

        $menu = Menu::ofPublished()->where('parent_id', null)->where('menu_position', 'footer_menu')->orderBy('sequence')->get();

        foreach ($menu as $nav) {

            $submenu = "";
            foreach ($nav->published_children as $key => $subnav) {
                $submenu .= "<li>" . NavHelper::RenderMenuItem($subnav) . "</li>";
            }

            $root .= " <div class=\"col-md-4\">
                        <h1 data-toggle=\"collapse\" data-target=\"#collapseOther\" aria-expanded=\"false\" aria-controls=\"collapseOther\" class=\"list-topic\">" . $nav->title . "</span></h1>";

            if (count($nav->children) > 0) {
                $root .= "<ul id=\"collapseOther\" aria-labelledby=\"headingOne\" data-parent=\"#footerToggle\" class=\"list-group collapse\">";
                $root .= $submenu;
                $root .= "</ul>";
            }

            $root .= "</div>";
        }

        return $root;
    }

    public static function RenderMenuItem($item, $css = "", $attr = "")
    {
        if ($item->menu_type_id == MenuTypeEnum::BLANK)
            return "<a href=\"javascript:;\" class=\"$css\" $attr>$item->title</a>";
        else if ($item->menu_type_id == MenuTypeEnum::CONTENT) {
            return "<a href=\"" . url('contents/' . $item->content_id) . "\" class=\"$css\" $attr>$item->title</a>";
        } else if ($item->menu_type_id == MenuTypeEnum::CONTENT_CATEGORY) {
            return "<a href=\"" . url("categories/" . $item->content_id) . "\" class=\"$css\" $attr>$item->title</a>";
        } else if ($item->menu_type_id == MenuTypeEnum::WEBLINK) {
            $target = $item->target == '_blank' ? $item->target : "_self";
            return "<a href=\"$item->url\" target=\"$target\" class=\"$css\" $attr>$item->title</a>";
        } else if ($item->menu_type_id == MenuTypeEnum::INTERNALLINK) {
            return "<a href=\"".url("$item->url")."\" class=\"$css\" $attr>$item->title</a>";
        }

        return "";
    }
}
