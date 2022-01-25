<?php

namespace App\Observers;

use App\Models\ContentType;

class ContentTypeObserver
{

    public function created(ContentType $type)
    {
        $type->sequence = $type->id;
        unset($type->id);
        $type->update();
    }

}
