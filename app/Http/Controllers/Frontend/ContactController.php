<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index () {
        return view('frontend.contacts.index');
    }

    public function form () {
        return view('frontend.contacts.form');
    }

    public function store (Request $request) {
        Message::create($request->all());
        return redirect(url('contact-us'))->withSuccess('');
    }
}
