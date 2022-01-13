<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {

        if (!$request->q)
            abort(404);

        $contents = Content::where('tags', 'LIKE', "%$request->q%")->get();

        return view('frontend.tags', compact('contents'));
    }
}
