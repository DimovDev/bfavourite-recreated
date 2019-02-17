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
        ->add('About Sashe', '#')
        ->add('Projects', '#')
        ->add('Blog', '#')
        ->add('Admin Panel', '#')
        ->add('Contacts', '#');

        SimpleMenu::execute();

        $url = url()->current();

    
        if(SimpleMenu::findByUrl($url)->exists()) {

            SimpleMenu::findByUrl($url)->setActive(true)->execute();
        }
        
        if(strpos($url, '/admin/') !== false ) {

            SimpleMenu::find('Admin Panel')->setActive(true)->execute();
        }

        

        return $next($request);
    }
}
