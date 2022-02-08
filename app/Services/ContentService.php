<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Models\Content;
use App\Models\Event;
use App\Models\Registrar;
use App\Models\Survey;
use Carbon\Carbon;

class ContentService
{
    public function getPublishedContentsExceptCurrent(Content $content, $limit = 5)
    {
        $contents = Content::ofPublished()
            ->orderByDesc('pinned')
            ->orderByDesc('created_at')
            ->where('id', '!=', $content->id)
            ->where('content_type_id', $content->content_type_id)
            ->limit($limit)
            ->get();
        return $contents;
    }

    public function getPublishedSurveysExceptCurrent(Survey $content, $limit = 5)
    {
        $surveys = Survey::ofPublished()
            ->orderByDesc('created_at')
            ->where('id', '!=', $content->id)
            ->limit($limit)
            ->get();
        return $surveys;
    }

    public function getPublishedRegisterFormsExceptCurrent(Registrar $content, $limit = 5)
    {
        $forms = Registrar::ofPublished()
            ->orderByDesc('created_at')
            ->where('id', '!=', $content->id)
            ->limit($limit)
            ->get();

        return $forms;
    }
}
