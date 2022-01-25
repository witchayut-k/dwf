<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use Spatie\Activitylog\Models\Activity;
// use App\Observers\ActivityLogObserver;

use App\Models\Content;
use App\Models\ContentType;
use App\Observers\ContentObserver;
use App\Observers\ContentTypeObserver;

class ModelEventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Register Event Observer Here !
        Content::observe(ContentObserver::class);
        ContentType::observe(ContentTypeObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
