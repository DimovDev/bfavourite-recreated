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

            'post' => 'App\Models\Asset\Post',
            'project' => 'App\Models\Asset\Project',
            'photoNote' => 'App\Models\Asset\PhotoNote',
            'linkNote' => 'App\Models\Asset\LinkNote',
            'textNote' => 'App\Models\Asset\TextNote',
            'tag' => 'App\Models\Taxonomy\Tag',
            'asset' => 'App\Models\Asset\Asset',
            'asset' => 'App\Models\Asset\Note'

        ]);
        

        \Blade::directive('thumbnail', function ($img) {
    
            return "<?php echo '/storage'.
                               (file_exists(storage_path(config('media.images.upload_path')).str_replace('.', '_small.', {$img})) ?
                               str_replace('.', '_small.', {$img}) : {$img}); ?>";

        });

           
      

        Blade::component('frontend/components/link', 'link');
        Blade::component('frontend/components/photo', 'photo');
        Blade::component('frontend/components/note', 'note');


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
