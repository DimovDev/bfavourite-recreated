<?php

namespace App\Models\Taxonomy;

use App\Helpers\SlugHelper;
use App\Helpers\PillFieldHelper;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
     
    protected $fillable = ['name', 'slug', 'taxonomy_status', 'taxonomy_type', 'icon_id', 'summary'];
    
    public function setIconIdAttribute($value) {

      if(!\is_integer($value)) {

        $value = json_decode($value);
    
        if(!empty($value) && !empty($value[0]->id)) {
          
          $value = (int) $value[0]->id;
        } else {
    
          $value = null;
        }
        
      }
     
      $this->attributes['icon_id'] = $value;

    }

    public static function create(array $data = []) {

      
      if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);

      if(!empty($data['asset_id']) && $data['asset_id'] != '[]') {
      
        $data['asset_id'] = PillFieldHelper::toArray($data['asset_id'])[0];
      } else {
  
        $data['asset_id'] = null;
      }
       
      $taxonomy =  static::query()->create($data);

      $taxonomy->user()->attach($data['user_id']);
      $taxonomy->user[0]->pivot->base_type = 'taxonomy';
      $taxonomy->user[0]->pivot->save();


      if($data['tags']) {


        $taxonomy->tags()->attach($data['tags']);

        $taxonomy->tags->map(function($tag, $index) {
          
          $tag->pivot->base_type = 'taxonomy';
          $tag->pivot->save();

        });
     
      }
      
  
     return $taxonomy;
   }

   public function update(array $data = [], array $options = []) {
  
    if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']); 

    if(!empty($data['asset_id']) && $data['asset_id'] != '[]') {
      
      $data['asset_id'] = PillFieldHelper::toArray($data['asset_id'])[0];
    } else {

      $data['asset_id'] = null;
    }
    
    $result = parent::update($data, $options);

    $this->tags()->sync($data['tags'] ?? []);

    $this->tags->map(function($tag, $index) {
          
      $tag->pivot->base_type = 'taxonomy';
      $tag->pivot->save();

     });
  
    
    return $result;

  }    
      
    public function delete() {

      $this->user()->detach();
      $this->tags()->detach();
       
      $result = parent::delete();

      return $result;
 
    }

    public function getFormattedAssetAttribute() {

      $asset = $this->asset()->first();
       
      return $asset ? json_encode([['id'=>$asset->id, 'value'=>str_limit($asset->title, 25).' #'.$asset->asset_type]]) : null;
      
    }

    public function getFormattedIconAttribute() {
   
      $icon = $this->icon()->first();
    
      return $icon ? json_encode([$icon->toArray()]) : null;
    
     }
    
     public function getFormattedTagsAttribute() {
           
      $tags = $this->tags()->get();
             
      return PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');
    
     }


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

        return $this->morphToMany('App\Models\User\User', 'obj', 'user_object')->withPivot('base_type');
  
      }


      public function icon() {

        return $this->belongsTo('App\Models\Media\Media', 'icon_id');
        
     }



}
