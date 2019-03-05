<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Asset\Asset;
use App\Models\Taxonomy\Tag;
use App\Models\Asset\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class StatsMiddleware
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
           
        $total_assets = Cache::remember('total_assets', 30, function(){
            
           return Asset::count();
 
        });

        View::share('total_assets', $total_assets);

        $total_techs = Cache::remember('total_techs', 30, function(){
            
            return Tag::techs()->count();
  
         });
 
         View::share('total_techs',  $total_techs);


         $total_projects = Cache::remember('total_projects', 30, function(){
             
             return Project::count();
   
          });
  
          View::share('total_projects',  $total_projects);

        return $next($request);
    }
}
