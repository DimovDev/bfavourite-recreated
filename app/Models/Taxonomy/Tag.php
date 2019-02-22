<?php

namespace App\Models\Taxonomy;

use App\Models\Taxonomy\Taxonomy;
use Illuminate\Database\Eloquent\Builder;

class Tag extends Taxonomy
{
    
    protected $table = 'taxonomies';

    protected $fillable = ['name', 'slug', 'taxonomy_status', 'taxonomy_type', 'icon', 'summary', 'asset_id'];

    protected $attributes = [
        
        'taxonomy_type' => 'tag'

    ];
  


    public static function boot() {

        parent::boot();

        static::addGlobalScope('taxonomy_type', function(Builder $builder) {

           $builder->where('taxonomy_type', 'tag');

        });

    }

        /*
     * Get all posts of the tag
     */
     
    public function posts() {

        return $this->morphedByMany('App\Post', 'obj', 'taxonomy_object', 'taxonomy_id');
     }  

         /*
     * Get all projects of the tag
     */
     
    public function projects() {

        return $this->morphedByMany('App\Project', 'obj', 'taxonomy_object', 'taxonomy_id');
     }  


   /* 
    * Get the tags of the tags 
    */

    public function tags() {

        return $this->morphToMany('App\Tag', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id');
  
      }

     
    /*
     * Get the assigned content piece 
     */

    public function asset() {

        return $this->belongsTo('App\Asset');
    }
    

}
