<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Budget;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\DocumentType;
use App\Models\Event;
use App\Models\LandingPage;
use App\Models\Menu;
use App\Models\Registrar;
use App\Models\VideoCategory;
use App\Models\Weblink;
use App\Models\WeblinkType;
use App\Services\ContentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index()
    {
        $landingPages = LandingPage::ofPublished()->get();

        $banners = Banner::ofPublished()->orderBy('sequence')->get();
        $linkServices = WeblinkType::ofService()->with('weblinks')->get();
        $linkSocials = WeblinkType::ofSocial()->with('weblinks')->get();
        $linkDepartments = WeblinkType::ofDepartment()->with('weblinks')->get();
        $linkRelated = WeblinkType::ofRelatedLink()->with('weblinks')->get();
        $linkGov = WeblinkType::ofGovLink()->with('weblinks')->first();

        $budget = Budget::first() ?: new Budget();

        $featuredContents = $contentTypes = ContentType::where('is_featured', true)->orderBy('sequence')->get();
        // $featuredContents = $this->getFeaturedContents();
        $activity = ContentType::find(6);

        $events = Event::ofAvailable()->orderBy('begin_date')->get();

        $videoCategories = $this->getVideoContents();

        $registerForms = Registrar::ofPublished()->get();

        $documentTypes = $this->getDocuments();

        return view(
            'frontend.home.index',
            compact(
                'landingPages',
                'banners',
                'linkServices',
                'linkSocials',
                'linkDepartments',
                'linkRelated',
                'linkGov',
                'featuredContents',
                'activity',
                'events',
                'videoCategories',
                'budget',
                'registerForms',
                'documentTypes',
            )
        );
    }

    /**
     * Display the specified content.
     *
     * @param  \App\Models\ContentType  $id
     * @param  \App\Models\Content  $content
     */
    // public function content($id, Content $content)
    // {
    //     $category = ContentType::find($id);

    //     if (empty($category) || !$category->published)
    //         abort(404);

    //     if (empty($content) || !$content->is_published)
    //         abort(404);

    //     $content->view_count++;
    //     $content->update();

    //     $tags = ContentType::ofPublished()->limit(10)->get();
    //     $moreContents = $this->contentService->getPublishedContentsExceptCurrent($content);

    //     return view('frontend.content_categories.detail', compact('content', 'tags', 'moreContents'));
    // }

    // private function getFeaturedContents()
    // {
    //     $contentTypes = ContentType::where('is_featured', true)->get();
    //     if (empty($contentType))
    //         abort(404);

    //     $newsList = $contentType->published_contents->sortByDesc('pinned');
    //     $chunks = $newsList->chunk(5);

    //     $contentType->featured_contents = $chunks->slice(0, 3);

    //     return $contentType;
    // }

    private function getVideoContents()
    {
        $videoCategories = VideoCategory::ofPublished()->get();

        foreach ($videoCategories as $category) {
            $chunks = $category->published_videos->chunk(5);
            $category->featured_videos = $chunks->slice(0, 3);
        }

        $results = $videoCategories->filter(function ($category) {
            return $category->featured_videos->count() > 0;
        });

        return $results;
    }

    private function getDocuments()
    {
        $documentTypes = DocumentType::ofPublished()->get();

        foreach ($documentTypes as $docType) {
            $docType->files = $docType->published_documents->slice(0, 10);
        }

        return $documentTypes;
    }
}
