<?php

namespace App\Models\Asset;

use App\Models\Asset\Asset;
use Illuminate\Database\Eloquent\Builder;

class Note extends Asset
{
    protected $attributes = ['asset_type' => 'asset'];


    protected $table = "assets";


  /* Get the tags of the asset / note 
   *
   */

  public function tags() {

    return $this->morphToMany('App\Models\Taxonomy\Tag', 'base', 'taxonomy_object', 'obj_id', 'taxonomy_id');

  }

   /* 
    * Get the owner of the project 
    */

    public function user() {

        return $this->morphToMany('App\Models\User\User', 'base', 'user_object', 'obj_id');

    }
  

}