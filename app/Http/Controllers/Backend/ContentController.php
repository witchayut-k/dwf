<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContentRequest;
use App\Models\Content;
use App\Models\ContentType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class ContentController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Content());
        $this->middleware(["permission:" . PermissionEnum::getDescription(PermissionEnum::MANAGE_CONTENT)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Content::select('contents.*', 't.name as type_name')
                ->leftJoin('content_types as t', 't.id', '=', 'contents.content_type_id');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Content::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            if ($request->content_type_id)
                $query = $query->where('contents.content_type_id', $request->content_type_id);

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->order(function ($query) {
                    $query->orderBy('contents.pinned', 'desc');
                    $query->orderBy('contents.created_at', 'desc');
                })
                ->make(true);
        }

        $contentTypes = ContentType::all();

        return view('backend.contents.index', compact('contentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = Content::where('title', 'Untitled')->count();
        $content = Content::create([
            'title' => 'Untitled' . ($count > 0 ? $count : ""),
            'content_type_id' => ContentType::first()->id
        ]);
        return redirect(url("admin/contents/$content->id/edit"));

        // $content = new Content();
        // $contentTypes = ContentType::options();
        // return view('backend.contents.create', compact('content', 'contentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        $this->transformRequest($request);
        $content = Content::create($request->all());

        if ($request->file) {
            $content->clearMediaCollection('featured_image');
            $content->addMedia($request->file)->toMediaCollection('featured_image');
        }

        if ($request->pdf) {
            $content->clearMediaCollection('file');
            $content->addMedia($request->pdf)->toMediaCollection('file');
        }

        return ResponseHelper::saveSuccess($request, $content);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return view('backend.contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $contentTypes = ContentType::options();
        return view('backend.contents.create', compact('content', 'contentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, Content $content)
    {
        $this->transformRequest($request);
        $content->update($request->all());

        if ($request->file) {
            $content->clearMediaCollection('featured_image');
            $content->addMedia($request->file)->toMediaCollection('featured_image');
        }

        // if ($request->pdf) {
        //     $content->clearMediaCollection('file');
        //     $content->addMedia($request->pdf)->toMediaCollection('file');
        // }

        return ResponseHelper::saveSuccess($request, $content);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Content $content)
    {
        $content->delete();
        return ResponseHelper::deleteSuccess($request, $content);
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

    public function uploadFiles(Request $request, Content $content)
    {
        foreach ($request->file as $key => $item) {
            // $fileName = $item->getClientOriginalName();
            $content
                ->addMedia($item)
                // ->usingName($fileName)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection('files');
        }
        return response()->json(['result' => $content]);
    }

    public function deleteFilesItem(Request $request, Content $content)
    {
        $media = Media::find($request->input('id'));
        $content->deleteMedia($media->id);
        return response()->json($request->all());
    }
}
