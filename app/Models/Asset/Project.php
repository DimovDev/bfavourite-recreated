<?php

namespace App\Models\Asset;

use App\Models\Asset\Asset;
use Illuminate\Database\Eloquent\Builder;

class Project extends Asset
{
    protected $attributes = ['asset_type' => 'project'];


    protected $table = "assets";

    public static function boot() {

      parent::boot();

      static::addGlobalScope('asset_type', function(Builder $builder) {

         $builder->where('asset_type', 'project');

      });

  }

  public function scopeFeatured($query, $count) {

     return $query->join('taxonomy_object', function($join) {
          
        $join->on('obj_id', '=', 'assets.id');
        $join->on('obj_type', '=', 'assets.asset_type');
      
     })->where('taxonomy_id', 51)
       ->where('asset_status', 'publish')
       ->take($count);

  }
  

}
