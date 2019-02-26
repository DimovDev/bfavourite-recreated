<?php

namespace App\Models\Taxonomy;

use Illuminate\Database\Eloquent\Model;

class TaxonomyPivot extends Model
{
    protected $table = "taxonomy_object";

    public function scopeWithData($query, $taxonomy_type) {
         
           $query->join('taxonomies', 'taxonomy_id', '=', 'taxonomies.id')
                 ->where('taxonomy_type', $taxonomy_type)
                 ->select('taxonomies.*', 'obj_id', 'obj_type');

    }
}
