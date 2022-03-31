<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class AlbumController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Album());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_ALBUM)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Album::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Album::searchFields();
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
                    $query->orderBy('created_at', 'desc');
                })
                ->make(true);
        }
        return view('backend.albums.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = Album::where('title', 'New album')->count();

        $album = Album::create([
            'title' => 'New album' . ($count > 0 ? $count : "")
        ]);

        return redirect(url("admin/albums/$album->id/edit"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        $album = Album::create($request->all());

        if ($request->file)
            UploadHelper::addMedia($request->file, $album, "featured_image");

        return ResponseHelper::saveSuccess($request, $album);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return view('backend.albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('backend.albums.create', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, Album $album)
    {
        $album->update($request->all());
        
        if ($request->file)
            UploadHelper::addMedia($request->file, $album, "featured_image");

        return ResponseHelper::saveSuccess($request, $album);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Album $album)
    {
        $album->delete();
        return ResponseHelper::deleteSuccess($request, $album);
    }

    // public function gallery(Request $request, Album $album)
    // {
    //     if (!$album) return [];

    //     $gallery = $album->getMedia('gallery_images');

    //     $results = [];
    //     foreach ($gallery as $item) {
    //         $gallery = [];
    //         $gallery['id'] = $item->id;
    //         $gallery['url'] = url($item->getUrl());
    //         $results[] = $gallery;
    //     }

    //     return response()->json($results);
    // }

    public function uploadGallery(Request $request, Album $album)
    {
        foreach ($request->file as $key => $item) {
            // $fileName = $item->getClientOriginalName();
            $album
                ->addMedia($item)
                // ->usingName($fileName)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection('gallery_images');
        }
        return response()->json(['result' => $album]);
    }

    public function deleteGalleryItem(Request $request, Album $album)
    {
        $media = Media::find($request->input('id'));
        $album->deleteMedia($media->id);
        return response()->json($request->all());
    }
}
