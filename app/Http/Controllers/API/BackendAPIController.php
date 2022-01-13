<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\WeblinkType;
use Illuminate\Http\Request;

class BackendAPIController extends Controller
{
    public function getWeblinkTypes () {

        $types = WeblinkType::where('parent_type_id', NULL)->with('types')->get();

        return response()->json($types);
    }

    public function getMainNenus (Request $request) {

        $menus = Menu::where('parent_id', NULL)->where('menu_position', $request->position)->orderBy('sequence')->get();

        return response()->json($menus);
    }
}
