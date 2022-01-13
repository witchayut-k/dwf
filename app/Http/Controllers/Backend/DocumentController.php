<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Document());
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
            $query = Document::select('documents.*', 'document_types.type_name')
                ->leftJoin('document_types', 'document_types.id', '=', 'documents.document_type_id');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Document::searchFields();
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

        return view('backend.documents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        $documentTypes = DocumentType::options();
        return view('backend.documents.create', compact('document', 'documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = Document::create($request->all());

        dd($request->file());

        if ($request->file) {
            $document->clearMediaCollection('file');
            $document->addMedia($request->file)->toMediaCollection('file');
        }

        return ResponseHelper::saveSuccess($request, $document);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $documentTypes = DocumentType::options();
        return view('backend.documents.create', compact('document', 'documentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $document->update($request->all());

        if ($request->file) {
            $document->clearMediaCollection('file');
            $document->addMedia($request->file)->toMediaCollection('file');
        }

        return ResponseHelper::saveSuccess($request, $document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Document $document)
    {
        $document->delete();
        return ResponseHelper::deleteSuccess($request, $document);
    }
}
