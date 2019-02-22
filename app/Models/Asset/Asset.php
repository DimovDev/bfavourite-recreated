<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\SlugHelper;

class Asset extends Model
{
    protected $fillable = ['title', 'slug', 'asset_status', 'summary', 'content', 'published_at', 'photo'];

    protected $dates = ['published_at'];


    public function setSlugAttribute($value) {

        $value = $value ? $value : $this->title;
  
        $slug = SlugHelper::generate(__CLASS__, $value, $this->id);
  
        $this->attributes['slug'] = $slug; 
  
      }

      public function setSummaryAttribute($value) {

        $value = $value ? $value : str_limit(strip_tags($this->content), 255);
  
  
        $this->attributes['summary'] = $value; 
  
      }
     

      public function getStatusAttribute($value) {
  
          return $this->asset_status;
      }

      public function photo() {

         return $this->belongsTo('App\Models\Media\Media', 'photo');
         
      }


   /**
     * Get the meta fields for the project asset.
    */

    public function assetsMeta() {

      return $this->hasMany('App\Models\Asset\AssetMeta', 'asset_id');

   }

   public function getMeta($key) {

       $result = $this->assetsMeta()->where('meta_key', $key);

       if($result->count()) return $result->first()->meta_value;

   }

       /* 
        * Get the owner of the project 
        */

       public function user() {

         return $this->morphToMany('App\Models\User\User', 'obj', 'user_object');
   
       }

       
   /* 
    * Get the tags of the post 
    */

    public function tags() {

      return $this->morphToMany('App\Models\Taxonomy\Tag', 'obj', 'taxonomy_object', null, 'taxonomy_id');

    }


}