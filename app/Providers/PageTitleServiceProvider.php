<?php

namespace App\Providers;

use App\Helpers\PageTitleHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class PageTitleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(PageTitleHelper $page_title)
    {     
        $page_title->setDelimiter(' &raquo; ');
        View::share('page_title', $page_title);   

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PageTitleHelper::class, function($app) {
            
            return new PageTitleHelper();

        });
    }
}
