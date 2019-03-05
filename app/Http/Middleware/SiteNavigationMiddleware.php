<?php

namespace App\Http\Middleware;

use App\Helpers\Menu\Facades\SimpleMenu;

use Closure;

class SiteNavigationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   

 
        SimpleMenu::add('Site Navigation');
        
        SimpleMenu::find('Site Navigation')
        ->add('Home', url('/'))
        ->add('About Sashe', route('pages.about'))
        ->add('Projects', route('newsfeed.projects'))
        ->add('Blog', route('newsfeed.posts'))
        ->add('Contacts', route('pages.contacts'));

        SimpleMenu::execute();

        $url = url()->current();

    
        if(SimpleMenu::findByUrl($url)->exists()) {

            SimpleMenu::findByUrl($url)->setActive(true)->execute();
        }
          

        return $next($request);
    }
}
