<?php

namespace App\Observers;

use App\Models\ContentType;

class ContentTypeObserver
{

    public function creating(ContentType $contentType)
    {
        \Log::info("ContentTypeObserver::creating");
        $sequence = ContentType::orderByDesc('sequence')->first()->sequence;
        $contentType->sequence = $sequence + 1;
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
