<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index (Request $request) {
        $categories = VideoCategory::ofPublished()->get();

        if ($request->category) {
            $category = VideoCategory::ofPublished()->where('id', $request->category)->first();
        } else {
            $category = VideoCategory::ofPublished()->first();
            return redirect(url("videos?category=$category->id"));
        }

        // foreach ($categories as $category) {
        //     $category->published_videos = $category->videos->slice(0, 8);
        // }

        // dd($categories);

        $videos = Video::where('video_category_id', $request->category)->orderByDesc('created_at')->paginate(12);
        $videos->appends(['category' => $request->category]);

        return view('frontend.videos.index', compact('categories', 'videos', 'request'));
    }
}
