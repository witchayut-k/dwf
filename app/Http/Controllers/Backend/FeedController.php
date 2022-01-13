<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Models\Faq;
use Illuminate\Http\Request;

class FeedController extends BaseController
{
    
    public function __construct()
    {
        parent::__construct(new Faq());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_FAQ)]);
    }

    public function index()
    {
        return view('backend.feeds.index');
    }
}
