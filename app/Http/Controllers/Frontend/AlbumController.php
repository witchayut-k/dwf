<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index () {
        $albums = Album::ofPublished()->orderByDesc('created_at')->paginate(12);
        return view('frontend.albums.index', compact('albums'));
    }

    public function show (Album $album) {

        $album->view_count++;
        $album->update();

        return view('frontend.albums.detail', compact('album'));
    }
}
