<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\DocumentType;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index (Request $request) {

        if ($request->id) {
            return $this->download($request);
        }

        $documentTypes = $this->getDocuments();
        return view('frontend.download', compact('documentTypes'));
    }

    private function getDocuments() {

        $documentTypes = DocumentType::ofPublished()->get();
        return $documentTypes;
    }

    private function download($request) {
        $document = Document::find($request->id);
        $document->view_count++;
        $document->download_count++;
        $document->update();
        
        return redirect(url($document->file->getFullUrl()));
        
    }
}
