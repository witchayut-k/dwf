<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Banner());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_BANNER)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Banner::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Banner::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('featured_image', function ($content) {
                    return $content->featured_image_resized;
                })
                ->order(function ($query) {
                    $query->orderBy('sequence', 'desc');
                    $query->orderBy('created_at', 'desc');
                })
                ->make(true);
        }

        return view('backend.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = new Banner();
        return view('backend.banners.create', compact('banner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->transformRequest($request);
        $banner = Banner::create($request->all());

        if ($request->file) {
            $banner->clearMediaCollection('featured_image');
            $banner->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::saveSuccess($request, $banner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('backend.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('backend.banners.create', compact('banner'));
    }

    /**
     * Update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $this->transformRequest($request);
        $banner->update($request->all());

        if ($request->file) {
            $banner->clearMediaCollection('featured_image');
            $banner->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::saveSuccess($request, $banner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banner $banner)
    {
        $banner->delete();
        return ResponseHelper::deleteSuccess($request, $banner);
    }

    public function transformRequest(Request &$request)
    {
        if ($request->begin_date) {
            $beginDate = Carbon::createFromFormat("d/m/Y", trim($request->begin_date));
            $request->merge(['begin_date' => $beginDate]);
        }

        if ($request->end_date) {
            $endDate = Carbon::createFromFormat("d/m/Y", trim($request->end_date));
            $request->merge(['end_date' => $endDate]);
        }
    }
}
