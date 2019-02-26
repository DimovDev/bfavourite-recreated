<?php

namespace App\Models\Taxonomy;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\SlugHelper;

class Taxonomy extends Model
{
     
    protected $fillable = ['name', 'slug', 'taxonomy_status', 'taxonomy_type', 'icon_id', 'summary'];

    public function setSlugAttribute($value) {

      $value = $value ? $value : $this->name;

      $slug = SlugHelper::generate(__CLASS__, $value, $this->id);

      $this->attributes['slug'] = $slug; 

    }

    public function getStatusAttribute($value) {

        return $this->taxonomy_status;
    }

   /* 
    * Get the owner of the taxonomy 
    */

    public function user() {

        return $this->morphToMany('App\Models\User\User', 'obj', 'user_object');
  
      }


      public function icon() {

        return $this->belongsTo('App\Models\Media\Media', 'icon_id');
        
     }



}
