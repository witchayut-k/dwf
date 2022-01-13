<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index () {
        $menu = Menu::ofPublished()->where('parent_id', null)->where('menu_position', 'top_menu')->orderBy('sequence')->get();
        
        return view('frontend.sitemap', compact('menu'));
    }
}
