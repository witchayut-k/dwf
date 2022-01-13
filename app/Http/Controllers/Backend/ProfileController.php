<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first() ?: new Profile();
        return view('backend.profiles.index', compact('user', 'profile'));
    }

    public function store(Request $request)
    {
        $profile = Profile::create($request->all());

        if ($request->file) {
            $profile->clearMediaCollection('file');
            $profile->addMedia($request->file)->toMediaCollection('file');
        }

        return ResponseHelper::updateSuccess($request, $profile);
    }

    public function update(Request $request, Profile $profile)
    {

        $profile->update($request->all());

        if ($request->file) {
            $profile->clearMediaCollection('file');
            $profile->addMedia($request->file)->toMediaCollection('file');
        }

        return ResponseHelper::updateSuccess($request, $profile);
    }

    /**
     * Media
     */
    public function uploadAvatar(Request $request)
    {
        $content = User::find($request->id);
        if ($request->file != null)
            UploadHelper::addMedia($request->file, $content, 'avatar_image');

        return response()->json(['result' => $content]);
    }
}
