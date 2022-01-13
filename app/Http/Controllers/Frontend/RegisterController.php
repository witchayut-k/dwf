<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Registered;
use App\Models\Registrar;
use App\Services\ContentService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    
    public function index (Request $request, Registrar $registrar) {
        $form = $registrar;
        $moreForms = $this->contentService->getPublishedRegisterFormsExceptCurrent($registrar);
        return view('frontend.registrar_form', compact('form', 'moreForms'));
    }

    public function store (Request $request) {

        Registered::create($request->all());

        return redirect(url("registers/$request->registrar_id"))->withSuccess('');
    }
}
