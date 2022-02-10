<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Budget;
use App\Models\Content;
use App\Models\ContentType;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Event;
use App\Models\LandingPage;
use App\Models\Menu;
use App\Models\Registrar;
use App\Models\Video;
use App\Models\VideoCategory;
use App\Models\Weblink;
use App\Models\WeblinkType;
use App\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index()
    {
        /** Redirect to landing page if exists */

        $landingPageFull = LandingPage::ofPublished()->ofFullPage()->get();

        if ($landingPageFull->count() > 0 && !session('skip_landing_page'))
            return view( 'frontend.home.landing', compact('landingPageFull'));

        /** End redirect to landing page */

        $popups = LandingPage::ofPublished()->ofPopup()->get();

        $banners = Banner::ofPublished()->orderBy('sequence')->get();

        $linkServices = WeblinkType::ofService()->ofPublished()
            ->with([
                    'weblinks' => function ($query) {
                        $query->where('published', true);
                        $query->orderBy('sequence');
                    }
                ])
            ->get();

        $linkSocials = WeblinkType::ofSocial()->ofPublished()
            ->with([
                'weblinks' => function ($query) {
                    $query->where('published', true);
                    $query->orderBy('sequence');
                }
            ])->get();

        $linkDepartments = WeblinkType::ofDepartment()->ofPublished()
            ->with([
                'weblinks' => function ($query) {
                    $query->where('published', true);
                    $query->orderBy('sequence');
                }
            ])->get();

        $linkRelated = WeblinkType::ofRelatedLink()->ofPublished()
            ->with([
                'weblinks' => function ($query) {
                    $query->where('published', true);
                    $query->orderBy('sequence');
                }
            ])->get();

        $linkGov = WeblinkType::ofGovLink()->ofPublished()
            ->with([
                'weblinks' => function ($query) {
                    $query->where('published', true);
                    $query->orderBy('sequence');
                }
            ])->first();

        $budget = Budget::first() ?: new Budget();

        // $featuredContents = ContentType::ofFeatured()->ofPublished()->orderBy('sequence')->get();
        $featuredContents = $this->getFeaturedContents();
        $activity = ContentType::find(6);

        $events = Event::ofAvailable()->orderBy('begin_date')->get();

        $videos = $this->getVideoContents();
        $documents = $this->getDocuments();

        $registerForms = Registrar::ofPublished()->get();

        $announces = $this->getAnnounces();


        return view(
            'frontend.home.index',
            compact(
                'popups',
                'banners',
                'linkServices',
                'linkSocials',
                'linkDepartments',
                'linkRelated',
                'linkGov',
                'featuredContents',
                'activity',
                'events',
                'videos',
                'documents',
                'budget',
                'registerForms',
                'announces',
            )
        );
    }

    public function skipLandingPage () {
        session(['skip_landing_page' => true]);
        return redirect(url(''));
    }

    /**
     * Private Methods
     */

    private function getFeaturedContents()
    {
        $contentTypes = ContentType::ofFeatured()->ofPublished()->orderBy('sequence')->get();
        // if (empty($contentType))
        //     abort(404);
        foreach ($contentTypes as $key => $contentType)
        {
            if ($contentType->name == "ข่าวภูมิภาค") {
                $contentType->featured_contents = $contentType->published_contents->take(8);
            } else {
                $contentType->featured_contents = $contentType->published_contents->take(5);
            }
        }

        // $newsList = $contentType->published_contents->sortByDesc('pinned');
        // $chunks = $newsList->chunk(5);

        // $contentType->featured_contents = $chunks->slice(0, 3);

        return $contentTypes;
    }

    private function getVideoContents()
    {
        // $chunks = Video::ofPublished()->orderByDesc('created_at')->get()->chunk(5);
        // $videos = $chunks->slice(0, 3);
        $videos = Video::ofPublished()->orderByDesc('created_at')->take(5)->get();

        return $videos;

        // $videoCategories = VideoCategory::ofPublished()->get();

        // foreach ($videoCategories as $category) {
        //     $chunks = $category->published_videos->chunk(5);
        //     $category->featured_videos = $chunks->slice(0, 3);
        // }

        // $results = $videoCategories->filter(function ($category) {
        //     return $category->featured_videos->count() > 0;
        // });

        // return $results;
    }

    private function getDocuments()
    {
        return Document::ofPublished()->orderByDesc('created_at')->take(10)->get();
        // $documentTypes = DocumentType::ofPublished()->get();

        // foreach ($documentTypes as $docType) {
        //     $docType->files = $docType->published_documents->slice(0, 10);
        // }

        // return $documentTypes;
    }

    private function getAnnounces()
    {
        $contentTypes =  ContentType::ofAnnounce()->ofPublished()->orderBy('sequence')->get();

        foreach ($contentTypes as $type) {
            $type->published_contents = $type->published_contents->slice(0, 10);
        }

        return $contentTypes;
    }
}
