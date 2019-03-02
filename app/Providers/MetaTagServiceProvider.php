<?php

namespace App\Providers;

use App\Helpers\MetaTagHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MetaTagServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(MetaTagHelper $meta_tags)
    {   

        View::share('meta_tags', $meta_tags);          
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MetaTagHelper::class, function($app) {
            
            return new MetaTagHelper();

        });
    }
}
