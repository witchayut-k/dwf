<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\ContentType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContentTypeController extends BaseController
{

    public function __construct()
    {
        parent::__construct(new ContentType());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_CONTENT)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ContentType::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = ContentType::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->order(function ($query) {
                    $query->orderBy('sequence', 'asc');
                    $query->orderBy('created_at', 'desc');
                    
                })
                ->make(true);
        }

        return view('backend.content_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contentType = new ContentType();
        return view('backend.content_types.create', compact('contentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contentType = ContentType::create($request->all());

        return ResponseHelper::saveSuccess($request, $contentType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentType  $contentType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentType $contentType)
    {
        return view('backend.content_types.create', compact('contentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentType  $contentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentType $contentType)
    {
        $contentType->update($request->all());

        return ResponseHelper::saveSuccess($request, $contentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentType  $contentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ContentType $contentType)
    {
        $contentType->delete();
        return ResponseHelper::deleteSuccess($request, $contentType);
    }
}
