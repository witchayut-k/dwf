<?php

namespace App\Http\Controllers\API;

use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaAPIController extends Controller
{
    /**
     * Upload image from RTE
     */
    public function uploadRTE(Request $request)
    {
        $imageUrl = UploadHelper::uploadFile($request, 'content', TRUE);
        return response()->json(["link" => $imageUrl]);
    }
}
