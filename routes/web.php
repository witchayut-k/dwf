<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AlbumController as BackendAlbumController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BudgetController;
use App\Http\Controllers\Backend\ContactController as BackendContactController;
use App\Http\Controllers\Backend\ContentTypeController;
use App\Http\Controllers\Backend\DocumentController;
use App\Http\Controllers\Backend\DocumentTypeController;
use App\Http\Controllers\Backend\EventController as BackendEventController;
use App\Http\Controllers\Backend\FeedController;
use App\Http\Controllers\Backend\LandingPageController;
use App\Http\Controllers\Backend\MapController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\PetitionController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Backend\RegistrarController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoCategoryController;
use App\Http\Controllers\Backend\VideoController as BackendVideoController;
use App\Http\Controllers\Backend\WeblinkController;
use App\Http\Controllers\Backend\WeblinkTypeController;
use App\Http\Controllers\Backend\ContentController as BackendContentController;
use App\Http\Controllers\Backend\FaqController as BackendFaqController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\SurveyController as BackendSurveyController;
use App\Http\Controllers\Backend\UserRoleController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ContentController;
use App\Http\Controllers\Frontend\DownloadController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\RSSController;
use App\Http\Controllers\Frontend\AlbumController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\VideoController;
use App\Http\Controllers\Frontend\SurveyController;
use App\Http\Controllers\Frontend\TagController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('lang/{lang}', [LanguageController::class, 'switchLang']);

Route::name('home')->middleware('visitor')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    // Route::get('categories/{id}/{content}', [HomeController::class, 'content']);
    Route::get('faq', [FaqController::class, 'index'])->name('faq');
    Route::put('faq/{faq}', [FaqController::class, 'update']);
    Route::get('categories/{id}', [ContentController::class, 'categories'])->name('categories');
    Route::get('contents/{content}', [ContentController::class, 'index'])->name('contents')->middleware('view_count');
    Route::get('events', [EventController::class, 'index']);
    Route::get('events/{event}', [EventController::class, 'show']);
    Route::get('videos', [VideoController::class, 'index']);
    Route::get('registers/{registrar}', [RegisterController::class, 'index']);
    Route::post('registers', [RegisterController::class, 'store']);
    Route::get('downloads', [DownloadController::class, 'index']);
    Route::get('rss', [RSSController::class, 'index']);
    Route::get('profile/{id}', [ProfileController::class, 'index']);
    Route::get('albums', [AlbumController::class, 'index']);
    Route::get('albums/{album}', [AlbumController::class, 'show']);
    Route::get('surveys/{survey}', [SurveyController::class, 'index']);
    Route::post('surveys', [SurveyController::class, 'store']);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contact-us', [ContactController::class, 'form']);
    Route::post('contact-us', [ContactController::class, 'store']);
    Route::get('sitemap', [SitemapController::class, 'index']);
    Route::get('search', [SearchController::class, 'index']);
    Route::get('search/advance', [SearchController::class, 'advance']);
    Route::get('tags', [TagController::class, 'index']);
});

/**
 * Backend
 */
// Auth::routes();

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    
    Route::get('logout', [LoginController::class, 'logout']);

    // Dashboard
    Route::get('', [AdminController::class, 'index'])->name('backend');

    // Media picker
    Route::get('medias', [MediaController::class, 'getMediaList']);

    // User
    Route::prefix('users')->group(function () {
        Route::post('upload-avatar', [UserController::class, 'uploadAvatar']);
    });

    // Profile
    // Route::prefix('profile')->group(function () {
    //     Route::post('upload-avatar', [ProfileController::class, 'uploadAvatar']);
    // });

    // Landing Page
    Route::prefix('landing-page')->group(function () {
        Route::post('upload-featured', [LandingPageController::class, 'uploadFeatured']);
    });

    // Album
    Route::prefix('albums')->group(function () {
        Route::get('{album}/gallery', [BackendAlbumController::class, 'gallery']);
        Route::post('{album}/uploads/gallery', [BackendAlbumController::class, 'uploadGallery']);
        Route::delete('{album}/gallery', [BackendAlbumController::class, 'deleteGalleryItem']);
    });

    // Banner
    Route::prefix('banners')->group(function () {
        Route::post('upload-featured', [BannerController::class, 'uploadFeatured']);
        Route::post('sequence', [BannerController::class, 'updateSequence']);
    });

    // Menus
    Route::prefix('menus')->group(function () {
        Route::post('sequence', [MenuController::class, 'updateSequence']);
    });

    // Content Type
    Route::prefix('content-types')->group(function () {
        Route::post('sequence', [ContentTypeController::class, 'updateSequence']);
    });

    // Event
    Route::prefix('events')->group(function () {
        Route::get('calendar', [BackendEventController::class, 'calendar']);
    });

    // Contact
    Route::prefix('contacts')->group(function () {
        Route::post('sequence', [BackendContactController::class, 'updateSequence']);
    });

    // Registrar
    Route::prefix('registrars')->group(function () {
        Route::get('{registrar}/fields', [RegistrarController::class, 'getFields']);
    });

     // Survey
     Route::prefix('surveys')->group(function () {
        Route::get('{survey}/choices', [BackendSurveyController::class, 'getChoices']);
        Route::get('{survey}/questions', [BackendSurveyController::class, 'getQuestions']);
    });

    Route::resources([
        'users' => UserController::class,
        'faqs' => BackendFaqController::class,
        'documents' => DocumentController::class,
        // 'document-types' => DocumentTypeController::class,
        'banners' => BannerController::class,
        'albums' => BackendAlbumController::class,
        'videos' => BackendVideoController::class,
        // 'videos-categories' => VideoCategoryController::class,
        'surveys' => BackendSurveyController::class,
        'messages' => MessageController::class,
        'contacts' => BackendContactController::class,
        'events' => BackendEventController::class,
        'registrars' => RegistrarController::class,
        'petitions' => PetitionController::class,
        'weblinks' => WeblinkController::class,
        'feeds' => FeedController::class,
        'sitemaps' => SitemapController::class,
        // 'maps' => MapController::class,
        'profile' => BackendProfileController::class,
        'budgets' => BudgetController::class,
        'contents' => BackendContentController::class,
        'menus' => MenuController::class,
    ]);

    Route::resource('landing-pages', LandingPageController::class)->parameters([
        'landing-pages' => 'landingPage'
    ]);

    Route::resource('document-types', DocumentTypeController::class)->parameters([
        'document-types' => 'documentType'
    ]);

    Route::prefix('weblink-types')->group(function () {
        Route::get('{id}/create', [WeblinkTypeController::class, 'create']);
        Route::get('{weblinkType}/table', [WeblinkTypeController::class, 'table']);
        Route::get('{id}/{weblinkType}/edit', [WeblinkTypeController::class, 'edit']);
        Route::post('{id}/sequence', [WeblinkTypeController::class, 'updateSequence']);
        Route::delete('{id}/{weblinkType}', [WeblinkTypeController::class, 'destroy']);
    });

    Route::resource('weblink-types', WeblinkTypeController::class)->parameters([
        'weblink-types' => 'weblinkType'
    ]);

    Route::resource('video-categories', VideoCategoryController::class)->parameters([
        'video-categories' => 'videoCategory'
    ]);

    Route::resource('content-types', ContentTypeController::class)->parameters([
        'content-types' => 'contentType'
    ]);

    Route::resource('user-roles', UserRoleController::class)->parameters([
        'user-roles' => 'role'
    ]);

});


Route::prefix('dev')->group(function () {
    Route::get('config-clear', function () {
        Artisan::call('config:clear');
        echo "<h1>Config cleared!</h1>";
    });

    Route::get('config-cache', function () {
        Artisan::call('config:cache');
        echo "<h1>Config cached!</h1>";
    });

    Route::get('view-clear', function () {
        Artisan::call('view:clear');
        echo "<h1>View cleared!</h1>";
    });
});