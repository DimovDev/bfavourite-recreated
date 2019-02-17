<?php

namespace App;

use App\Taxonomy;
use Illuminate\Database\Eloquent\Builder;

class Tag extends Taxonomy
{
    
    protected $table = 'taxonomies';

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


    

}
