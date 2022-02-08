<?php

namespace App\Observers;

use App\Models\Banner;

class BannerObserver
{

    public function creating(Banner $banner)
    {
        \Log::info("BannerObserver::creating");
        $sequence = Banner::orderByDesc('sequence')->first()->sequence;
        $banner->sequence = $sequence + 1;
    }
    
    // public function created(ContentType $contentType)
    // {
    //     \Log::info("ContentTypeObserver::created");
    //     \DB::unprepared('SET IDENTITY_INSERT content_types ON');

    //     $contentType->sequence = $contentType->id;
    //     unset($contentType->id);
    //     $contentType->update();

    //     \DB::unprepared('SET IDENTITY_INSERT content_types OFF');
    // }

}
