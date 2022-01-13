<?php

namespace App\Http\Controllers\Backend;

use App\Enums\MenuTypeEnum;
use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\MenuRequest;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends BaseController
{

    public function __construct()
    {
        parent::__construct(new Menu());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_MENU)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Menu::select('menus.*')->orderBy('menus.sequence')
                ->leftJoin('menus as p', 'p.id', '=', 'menus.parent_id');


            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Menu::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            if ($request->menu_position)
                $query = $query->where('menus.menu_position', $request->menu_position);

            if ($request->main_menu_id) {
                $query = $query->where(function ($query) use ($request) {
                    $query->orWhere('menus.parent_id', $request->main_menu_id);
                    $query->orWhere('p.parent_id', $request->main_menu_id);
                });

                // $query = $query->where('parent_id', $request->main_menu_id);
                // $query = $query->orWhere('parent_id', $request->main_menu_id);
                
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('menu_type', function ($menu) {
                    return $menu->menu_type_id == MenuTypeEnum::BLANK && $menu->parent_id ? "เมนูย่อย" : MenuTypeEnum::getDescription($menu->menu_type_id);
                })
                ->addColumn('menu_content', function ($menu) {
                    if ($menu->menu_type_id == MenuTypeEnum::CONTENT)
                        return $menu->content ? $menu->content->title : "-";
                    else if ($menu->menu_type_id == MenuTypeEnum::CONTENT_CATEGORY)
                        return $menu->content_category ? $menu->content_category->name : "-";
                    else if ($menu->menu_type_id == MenuTypeEnum::WEBLINK)
                        return $menu->url;

                    return "-";
                })
                ->addColumn('parent_menu', function ($menu) {
                    $ancestor = null;
                    if ($menu->parent_menu && $menu->parent_menu->parent_menu) {
                        $ancestor = $menu->parent_menu->parent_menu;
                    }
                    $parent = $menu->parent_menu;

                    // $navPath = $ancestor ? $ancestor->title . " <br><i class=\"fa fa-angle-right\" style=\"color:#bf1864\"></i> " : "";
                    $navPath = $ancestor ? $ancestor->title . " <br><img src=\"../backend/img/icons/tree-child-line.png\" style=\"margin-top: -4px; margin-left: 4px\" /> " : "";
                    $navPath .= $parent ? $parent->title : "-";
                    return $navPath;

                })
                ->make(true);
        }

        return view('backend.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menu();
        $contents = Content::options();
        $contentTypes = ContentType::options();
        $mainMenus = Menu::where('parent_id', null)->get();
        return view('backend.menus.create', compact('menu', 'contents', 'contentTypes', 'mainMenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = Menu::create($request->all());
        return ResponseHelper::saveSuccess($request, $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $contents = Content::options();
        $contentTypes = ContentType::options();
        $mainMenus = Menu::where('parent_id', null)->get();
        return view('backend.menus.create', compact('menu', 'contents', 'contentTypes', 'mainMenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());
        return ResponseHelper::updateSuccess($request, $menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu)
    {
        $menu->delete();
        return ResponseHelper::deleteSuccess($request, $menu);
    }
}
