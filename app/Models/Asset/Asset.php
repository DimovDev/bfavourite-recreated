<?php

namespace App\Models\Asset;

use App\Helpers\SlugHelper;
use App\Models\Asset\AssetMeta;
use App\Helpers\PillFieldHelper;
use App\Models\Taxonomy\TaxonomyPivot;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['title', 'slug', 'asset_status', 'summary', 'content', 'published_at', 'photo_id'];

    protected $dates = ['published_at'];

  

    public static function create(array $data = []) {


      if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']);    
       
      $asset =  static::query()->create($data);

      $asset->user()->attach($data['user_id']);
      $asset->tags()->attach($data['tags']);
    
      $asset->user[0]->pivot->base_type = 'asset';
      $asset->user[0]->pivot->save();

      $asset->tags->map(function($tag, $index) {
          
          $tag->pivot->base_type = 'asset';
          $tag->pivot->save();

      });

      if($asset->id && !empty($data['meta'])) {
       
         foreach($data['meta'] as $key => $value ) {

          if($value) $asset->assetsMeta()->create(['asset_id' => $asset->id,
                                                   'meta_key' => $key,
                                                   'meta_value' => $value]); 

         }
      }
  
   return $asset;
 }



 public function setPhotoIdAttribute($value) {
  
  if(!\is_integer($value)) {

    $value = json_decode($value);

    if(!empty($value) && !empty($value[0]->id)) {
      
      $value = (int) $value[0]->id;
    } else {

      $value = null;
    }
    
  }
 
  $this->attributes['photo_id'] = $value;

 }

 
 public function getFormattedPhotoAttribute() {
   
  $photo = $this->photo()->first();

  return $photo ? json_encode([$photo->toArray()]) : null;

 }

 public function getFormattedTagsAttribute() {
       
  $tags = $this->tags()->get();
         
  return PillFieldHelper::dbRowsToJson($tags->toArray(), 'id', 'name');

 }


 public function update(array $data = [], array $options = []) {
    

    $result = parent::update($data, $options);


    if(!empty($data['tags'])) $data['tags'] = PillFieldHelper::toArray($data['tags']); 

    $this->tags()->sync($data['tags']);

    $this->tags->map(function($tag, $index) {
          
      $tag->pivot->base_type = 'asset';
      $tag->pivot->save();

     });
  

     if(!empty($data['meta'])) {
          
       foreach($data['meta'] as $key => $value ) { 
         
          if($value) {
          
              AssetMeta::updateOrcreate(['asset_id' => $this->id,
                                              'meta_key' => $key],
                                            ['meta_value' => $value]); 
          } else {
          
              AssetMeta::where('meta_key', $key)
                        ->where('asset_id', $this->id)
                        ->delete();
          }

       }

     } else {

       $this->assetsMeta()->delete();
       
     }
  
   return $result;

 }    
      
    public function delete() {

      $this->user()->detach();
      $this->tags()->detach();

      $this->assetsMeta()->delete();
       
      $result = parent::delete();

      return $result;
 
    }

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

         return $this->belongsTo('App\Models\Media\Media', 'photo_id');
         
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

         return $this->morphToMany('App\Models\User\User', 'obj', 'user_object')->withPivot('base_type');
   
       }

       
   /* 
    * Get the tags of the post 
    */

    public function tags() {

      return $this->morphToMany('App\Models\Taxonomy\Tag', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id')->withPivot('base_type');

    }


    public function scopePublished($query) {
         
      return $query->where('asset_status', 'publish')
                   ->where('published_at', '<=', date('Y-m-d h:i:s'))
                   ->orderBy('assets.published_at', 'DESC')
                   ->orderBy('assets.id', 'DESC');

    }

    public function scopePublishedNotes($query) {
       
      return  $query->where('asset_type', 'LIKE', '%Note%')
                    ->where('asset_status', 'publish')
                    ->where('assets.published_at', '<=', date('Y-m-d h:i:s'))
                    ->orderBy('assets.published_at', 'DESC')
                    ->orderBy('assets.id', 'DESC');

    }


  /*   public static function loadTags($assets) {

      $assets_ids = $assets->map(function($item, $key) {

        return $item->id;

       });  

       $assets_types = $assets->map(function($item, $key) {

          return $item->asset_type;

        });  

        
        $tags = TaxonomyPivot::withData('tag')
                                ->whereIn('obj_id', $assets_ids)
                                ->whereIn('obj_type', $assets_types)
                                ->where('taxonomy_status', 'active')
                                ->get();
           

        foreach($assets as $asset) {
          
            $asset->tags = $tags->filter(function($tag, $key) use($asset) {
            
                return $tag->obj_id == $asset->id && $tag->obj_type == $asset->asset_type;

            });


          }                       

          return $assets;
    }

    public static function assets() {

      $assets = Asset::published()->paginate();

      return Asset::loadTags($assets);

    }



    public static function notes() {
     
      $notes = Asset::PublishedNotes()->paginate();

      return Asset::loadTags($notes);
     
    } */

    public function getPublishDateAttribute() {

      return $this->published_at->format('d M Y');
    }



}
