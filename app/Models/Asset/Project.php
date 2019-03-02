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
  

}
