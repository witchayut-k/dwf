<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function  index($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        if (!$profile)
            abort(404);

        return view('frontend.profile', compact('profile'));
    }
}
