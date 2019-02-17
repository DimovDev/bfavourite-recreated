<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use App\Helpers\Menu\SimpleMenuBuilder;

class SimpleMenuProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(SimpleMenuBuilder $builder)
    {
        $view = $this->app->get('view');

        $view->share('simpleMenu', $builder);

        Blade::directive('simpleMenu', function ($expression) {

            [$menu, $view] = explode(',',str_replace(['(',')', "'"], '', $expression));

            return "<?php echo \$simpleMenu->find('$menu')->render('$view'); ?>";
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SimpleMenuBuilder::class, function($app) {
            
            $view = $app->get('view');

            return new SimpleMenuBuilder($view);

        });
    }
}
