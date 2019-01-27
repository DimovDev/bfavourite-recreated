<?php

namespace App;

use App\Asset;
use Illuminate\Database\Eloquent\Builder;

class Post extends Asset
{
    protected $attributes = ['asset_type' => 'post'];


    protected $table = "assets";

    public static function boot() {

        parent::boot();

        static::addGlobalScope('asset_type', function(Builder $builder) {

           $builder->where('asset_type', 'post');

        });

    }
    
    
    /* 
    * Get the owner of the project 
    */

    public function user() {

      return $this->morphToMany('App\User', 'obj', 'user_object');

    }

   /* 
    * Get the category of the project 
    */

    public function category() {

        return $this->morphToMany('App\Category', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id');
  
      }


}
