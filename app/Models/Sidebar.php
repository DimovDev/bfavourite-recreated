<?php

namespace App\Models;

use App\Models\Asset\Post;
use App\Models\Asset\Project;
use Illuminate\Support\Facades\DB;

class Sidebar {


    public function technologies() {

       $techs = DB::table('taxonomies')
                    ->join('taxonomy_object', function($join) {
                                            
                            $join->on('obj_id', '=', 'taxonomies.id')
                                ->on('obj_type', '=', 'taxonomies.taxonomy_type');

                        })  
                    ->join('taxonomy_object AS to', 'taxonomies.id', '=' , 'to.taxonomy_id')
                    ->join('assets', 'assets.id', '=', 'to.obj_id')
                    ->selectRaw('taxonomies.*, COUNT(to.id) AS assets_num')
                    ->where('taxonomy_object.taxonomy_id', 52)
                    ->where('taxonomies.taxonomy_status', '=', 'active')
                    ->where('asset_status', 'publish')
                    ->groupBy('taxonomies.id')
                    ->get();
  
        return $techs;

    }
    
    public function content() {

        $tags = DB::table('taxonomies')
                    ->selectRaw('taxonomy_type as obj_type, COUNT(id) AS assets_num')
                    ->groupBy('taxonomy_type');

        $content = DB::table('assets')
                     ->selectRaw('asset_type as obj_type, COUNT(id) AS assets_num')
                     ->groupBy('asset_type')
                     ->union($tags)
                     ->get();
        
          

        return $content;

    }

    public function current_project() {
     
        return Project::with('photo')
        ->join('taxonomy_object', function($join) {
         
            $join->on('asset_type', '=', 'obj_type')
                 ->on('assets.id', '=', 'obj_id');

        }) 
        ->where('asset_status', 'publish')
        ->where('taxonomy_id', 46)
        ->select('assets.*')
        ->orderBy('created_at', 'DESC')
        ->first(); 
       
    
    }

    public function recent_projects() {

        return Project::where('asset_status', 'publish')->orderBy('published_at', 'DESC')->take(3)->get();
    
    }

    public function recent_posts() {

        return Post::where('asset_status', 'publish')->orderBy('published_at', 'DESC')->take(5)->get();

    }

}