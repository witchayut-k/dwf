<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentTypeController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new DocumentType());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_DOWNLOAD)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = DocumentType::select('*')->orderByDesc('type_name');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = DocumentType::searchFields();
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

        return view('backend.document_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentType = new DocumentType();
        return view('backend.document_types.create', compact('documentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentType = DocumentType::create($request->all());
        return ResponseHelper::saveSuccess($request, $documentType, 'type_name');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function edit(DocumentType $documentType)
    {
        return view('backend.document_types.create', compact('documentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DocumentType $documentType)
    {
        $documentType->update($request->all());
        return ResponseHelper::saveSuccess($request, $documentType, 'type_name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentType  $documentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, DocumentType $documentType)
    {
        if ($documentType->documents->count() > 0) {
            return ResponseHelper::cannotDeleteDependency($request, $documentType, 'type_name');
        } 
        
        $documentType->delete();
        return ResponseHelper::deleteSuccess($request, $documentType, 'type_name');
    }
}
