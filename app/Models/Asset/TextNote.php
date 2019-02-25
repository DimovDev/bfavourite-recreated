<?php

namespace App\Models\Asset;

use App\Models\Asset\Asset;
use Illuminate\Database\Eloquent\Builder;

class TextNote extends Asset
{
    protected $attributes = ['asset_type' => 'textNote'];


    protected $table = "assets";

    public static function boot() {

        parent::boot();

        static::addGlobalScope('asset_type', function(Builder $builder) {

           $builder->where('asset_type', 'textNote');

        });

    }
    


}
