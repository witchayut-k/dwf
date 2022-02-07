<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ContentTemplateEnum;
use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentType;
use App\Services\ContentService;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(Content $content)
    {
        if (empty($content) || !$content->published || !$content->type || !$content->type->published)
            abort(404);

        $content->view_count++;
        $content->update();

        $tags = ContentType::ofPublished()->limit(10)->get();

        $moreContents = $this->contentService->getPublishedContentsExceptCurrent($content);

        $view = ContentTemplateEnum::getDescription($content->template_id);

        return view("frontend.content_categories.detail_{$view}", compact('content', 'moreContents', 'tags'));
    }

    public function categories(Request $request, $id)
    {
        $rowsPerPage = 12;

        $category = ContentType::find($id);

        if (empty($category) || !$category->published)
            abort(404);

        $contents = Content::ofPublished()->where('content_type_id', $category->id)->orderByDesc('pinned')->orderByDesc('created_at')->paginate($rowsPerPage);

        return view(
            'frontend.content_categories.index',
            compact(
                'category',
                'contents'
            )
        );
    }
}
