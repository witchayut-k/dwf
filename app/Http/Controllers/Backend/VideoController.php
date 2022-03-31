<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Video());
        $this->middleware(["permission:" . PermissionEnum::getDescription(PermissionEnum::MANAGE_VIDEO)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Video::select('videos.*', 'video_categories.title as category_name')
                ->leftJoin('video_categories', 'video_categories.id', '=', 'videos.video_category_id');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Video::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('featured_image', function ($content) {
                    return $content->video_preview_image;
                })
                ->order(function ($query) {
                    $query->orderBy('videos.created_at', 'desc');
                })
                ->make(true);
        }
        return view('backend.videos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video = new Video();
        $videoCategories = VideoCategory::options();
        return view('backend.videos.create', compact('video', 'videoCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = Video::create($request->all());

        if ($request->file)
            UploadHelper::addMedia($request->file, $video, "featured_image");

        if ($request->video)
            UploadHelper::addMedia($request->video, $video, "video");

        return ResponseHelper::saveSuccess($request, $video);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('backend.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $videoCategories = VideoCategory::options();
        return view('backend.videos.create', compact('video', 'videoCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $video->update($request->all());

        if ($request->file)
            UploadHelper::addMedia($request->file, $video, "featured_image");

        if ($request->video)
            UploadHelper::addMedia($request->video, $video, "video");

        return ResponseHelper::saveSuccess($request, $video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Video $video)
    {
        $video->delete();
        return ResponseHelper::deleteSuccess($request, $video);
    }
}
