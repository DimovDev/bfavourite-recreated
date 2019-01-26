<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\SlugHelper;

class Asset extends Model
{
    protected $fillable = ['title', 'slug', 'asset_status', 'summary', 'content', 'published_at'];

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

}
