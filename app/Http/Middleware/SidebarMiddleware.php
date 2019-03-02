<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Sidebar;
use Illuminate\Support\Facades\View;

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

        View::share('techs', $this->sidebar->technologies());
        View::share('content', $this->sidebar->content());
        View::share('recent_projects', $this->sidebar->recent_projects());
        View::share('recent_posts', $this->sidebar->recent_posts());
        View::share('current_project', $this->sidebar->current_project());

        return $next($request);
    }
}
