<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    
    public function getMediaList(Request $request)
    {
        $results = [];

        $medias = Media::all();

        $results = $medias->map(function ($media) {
            $media->url = $media->getFullUrl();
            $media->thumb = $media->getFullUrl();
            return $media;
        });

        return response()->json($results->makeVisible(['url', 'thumb', 'tag']));
    }
}
