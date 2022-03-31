<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WeblinkRequest;
use App\Models\Weblink;
use App\Models\WeblinkType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WeblinkController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Weblink());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_WEBLINK)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Weblink::select(
                'weblinks.*',
                't1.title as weblink_type',
                't2.title as parent_type'
            )
                ->leftJoin('weblink_types as t1', 't1.id', '=', 'weblinks.weblink_type_id')
                ->leftJoin('weblink_types as t2', 't2.id', '=', 't1.parent_type_id');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Weblink::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) { 
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            if ($request->parent_type_id)
                $query = $query->where('t1.parent_type_id', $request->parent_type_id);

            if ($request->weblink_type_id)
                $query = $query->where('weblinks.weblink_type_id', $request->weblink_type_id);

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->order(function ($query) {
                    $query->orderBy('weblinks.sequence', 'asc');
                })
                ->make(true);
        }

        return view('backend.weblinks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $weblink = new Weblink();
        return view('backend.weblinks.create', compact('weblink'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeblinkRequest $request)
    {
        $weblink = Weblink::create($request->all());

        if ($request->file) 
            UploadHelper::addMedia($request->file, $weblink, "featured_image");

        return ResponseHelper::saveSuccess($request, $weblink);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function show(Weblink $weblink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function edit(Weblink $weblink)
    {
        return view('backend.weblinks.create', compact('weblink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function update(WeblinkRequest $request, Weblink $weblink)
    {
        $weblink->update($request->all());

        if ($request->file) 
            UploadHelper::addMedia($request->file, $weblink, "featured_image");

        return ResponseHelper::saveSuccess($request, $weblink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weblink  $weblink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Weblink $weblink)
    {
        $weblink->delete();
        return ResponseHelper::deleteSuccess($request, $weblink);
    }
}
