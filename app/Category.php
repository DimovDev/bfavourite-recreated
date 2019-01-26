<?php

namespace App;

use App\Taxonomy;
use Illuminate\Database\Eloquent\Builder;

class Category extends Taxonomy
{
    
    protected $table = 'taxonomies';

    protected $attributes = [
        
        'taxonomy_type' => 'category'

    ];

    public static function boot() {

        parent::boot();

        static::addGlobalScope('taxonomy_type', function(Builder $builder) {

           $builder->where('taxonomy_type', 'category');

        });

    }


    

}
