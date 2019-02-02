<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        Relation::morphMap([
            'post' => 'App\Post',
            'project' => 'App\Project',
            'category' => 'App\Category'
        ]);
        

        \Blade::directive('thumbnail', function ($img) {
    
            return "<?php echo '/storage'.
                               (file_exists(storage_path(config('media.images.upload_path')).str_replace('.', '_small.', {$img})) ?
                               str_replace('.', '_small.', {$img}) : {$img}); ?>";

        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
