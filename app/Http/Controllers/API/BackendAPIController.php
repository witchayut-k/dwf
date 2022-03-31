<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Content;
use App\Models\Menu;
use App\Models\WeblinkType;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BackendAPIController extends Controller
{
    public function getWeblinkTypes () {

        $types = WeblinkType::where('parent_type_id', NULL)->with('types')->get();

        return response()->json($types);
    }

    public function getMainNenus (Request $request) {

        $menus = Menu::where('parent_id', NULL)->where('menu_position', $request->position)->orderBy('sequence')->get();

        return response()->json($menus);
    }

    public function getContentFiles (Content $content) {
        
        if (!$content) return [];

        $files = $content->getMedia('files');

        $results = [];
        foreach ($files as $item) {
            $file = [];
            $file['id'] = $item->id;
            $file['url'] = url($item->getUrl());
            $file['name'] = $item->file_name. " (".$item->human_readable_size.")";
            $results[] = $file;
        }

        return response()->json($results);
    }

    public function getGallery (Album $album) {

        if (!$album) return [];

        $gallery = $album->getMedia('gallery_images');

        $results = [];
        foreach ($gallery as $item) {
            $gallery = [];
            $gallery['id'] = $item->id;
            $gallery['url'] = url($item->getUrl());
            $results[] = $gallery;
        }

        return response()->json($results);
    }

    public function deleteMedia (Media $media) {
        $media->delete();
        return response()->json($media);

    }
}
