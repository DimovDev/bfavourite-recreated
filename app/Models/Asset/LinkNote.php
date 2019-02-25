<?php

namespace App\Models\Asset;

use App\Models\Asset\Asset;
use Illuminate\Database\Eloquent\Builder;

class LinkNote extends Asset
{
    protected $attributes = ['asset_type' => 'linkNote'];


    protected $table = "assets";

    public static function boot() {

      parent::boot();

      static::addGlobalScope('asset_type', function(Builder $builder) {

         $builder->where('asset_type', 'linkNote');

      });

  }

}