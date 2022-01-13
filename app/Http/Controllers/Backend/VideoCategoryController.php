<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new VideoCategory());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_VIDEO)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = VideoCategory::select('*')->with('videos');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = VideoCategory::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->make(true);
        }
        return view('backend.video_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videoCategory = new VideoCategory();
        return view('backend.video_categories.create', compact('videoCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $videoCategory = VideoCategory::create($request->all());
        return ResponseHelper::saveSuccess($request, $videoCategory);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoCategory $videoCategory)
    {
        return view('backend.video_categories.create', compact('videoCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoCategory $videoCategory)
    {
        $videoCategory->update($request->all());
        return ResponseHelper::saveSuccess($request, $videoCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, VideoCategory $videoCategory)
    {
        if ($videoCategory->videos->count() > 0) {
            return ResponseHelper::cannotDeleteDependency($request, $videoCategory);
        } 
        
        $videoCategory->delete();
        return ResponseHelper::deleteSuccess($request, $videoCategory);
    }
}
