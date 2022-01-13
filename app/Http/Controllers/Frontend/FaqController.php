<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index () {
        $faqs = Faq::ofPublished()->get();
        return view('frontend.faq', compact('faqs'));
    }

    public function update (Faq $faq) {
        $faq->view_count++;
        $faq->update();
        
        return response()->json($faq);
    }
}
