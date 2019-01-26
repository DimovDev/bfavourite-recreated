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


}
