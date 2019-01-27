<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\SlugHelper;

class Taxonomy extends Model
{
     
    protected $fillable = ['name', 'slug', 'taxonomy_status', 'taxonomy_type'];

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

        return $this->morphToMany('App\User', 'obj', 'user_object');
  
      }

}
