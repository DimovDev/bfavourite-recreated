<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class AssetMeta extends Model
{
    protected $table = 'assets_meta';
    protected $fillable = ['meta_key', 'meta_value', 'asset_id'];

    public function findByKey(string $key) {

        return AssetMeta::where('meta_key', $key)->get();

    }

    /**
     * Get the project that owns the meta property.
     */

     public function project() {

        return $this->belongsTo('App\Models\Asset\Project', 'asset_id');

     }

}
