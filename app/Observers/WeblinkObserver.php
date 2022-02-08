<?php

namespace App\Observers;

use App\Models\Weblink;

class WeblinkObserver
{

    public function creating(Weblink $weblink)
    {
        \Log::info("WeblinkObserver::creating");
        $sequence = Weblink::orderByDesc('sequence')->first()->sequence;
        $weblink->sequence = $sequence + 1;
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
