<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index () {
        abort(404);

        return view('frontend.album');
    }

    public function show (Album $album) {
        return view('frontend.album', compact('album'));
    }
}
