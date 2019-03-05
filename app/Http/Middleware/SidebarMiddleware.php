<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Sidebar;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class SidebarMiddleware
{

    protected $sidebar;

    public function __construct(Sidebar $sidebar) {

       $this->sidebar = $sidebar;

    }

    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $sidebar = Cache::remember('left_sidebar', 30, function () {

           $sidebar['techs'] = $this->sidebar->technologies();
           $sidebar['content'] = $this->sidebar->content();
           $sidebar['recent_projects'] = $this->sidebar->recent_projects();
           $sidebar['recent_posts'] = $this->sidebar->recent_posts();
           $sidebar['current_project'] = $this->sidebar->current_project();

           return $sidebar;
        });

        View::share('techs', $sidebar['techs']);
        View::share('content', $sidebar['content']);
        View::share('recent_projects',  $sidebar['recent_projects']);
        View::share('recent_posts', $sidebar['recent_posts']);
        View::share('current_project', $sidebar['current_project']);

        return $next($request);
    }
}
