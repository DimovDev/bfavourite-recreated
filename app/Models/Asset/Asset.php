<?php

namespace App\Models\Asset;

use App\Helpers\SlugHelper;
use App\Models\Asset\AssetMeta;
use App\Models\Taxonomy\TaxonomyPivot;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['title', 'slug', 'asset_status', 'summary', 'content', 'published_at', 'photo_id'];

    protected $dates = ['published_at'];


    public static function create(array $data = []) {
       
      $asset =  static::query()->create($data);

      if($asset->id && !empty($data['meta'])) {
       
         foreach($data['meta'] as $key => $value ) {

          if($value) $asset->assetsMeta()->create(['asset_id' => $asset->id,
                                                   'meta_key' => $key,
                                                   'meta_value' => $value]); 

         }
      }
  
   return $asset;
 }

 public function update(array $data = [], array $options = []) {

    $result = parent::update($data, $options);
  

     if(!empty($data['meta'])) {
          
       foreach($data['meta'] as $key => $value ) { 
         
          if($value) {
          
              AssetMeta::updateOrcreate(['asset_id' => $this->id,
                                              'meta_key' => $key],
                                            ['meta_value' => $value]); 
          } else {
          
              AssetMeta::where('meta_key', $key)->delete();
          }

       }

     } else {

       $this->assetsMeta()->delete();
       
     }
  
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

         return $this->morphToMany('App\Models\User\User', 'obj', 'user_object');
   
       }

       
   /* 
    * Get the tags of the post 
    */

    public function tags() {

      return $this->morphToMany('App\Models\Taxonomy\Tag', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id');

    }

    public function scopePublishedNotes($query) {
       
      return  $query->where('asset_type', 'LIKE', '%Note%')
                    ->where('asset_status', 'publish')
                    ->where('assets.published_at', '<=', date('Y-m-d h:i:s'))
                    ->orderBy('assets.published_at', 'DESC')
                    ->orderBy('assets.id', 'DESC');

    }


    public static function loadNotesTags($notes) {

      $notes_ids = $notes->map(function($item, $key) {

        return $item->id;

       });  

       $notes_types = $notes->map(function($item, $key) {

          return $item->asset_type;

        });  

        
        $tags = TaxonomyPivot::withData('tag')
                                ->whereIn('obj_id', $notes_ids)
                                ->whereIn('obj_type', $notes_types)
        
                                ->get();
          

        foreach($notes as $note) {
          
            $note->tags = $tags->filter(function($tag, $key) use($note) {
            
                return $tag->obj_id == $note->id && $tag->obj_type == $note->asset_type;

            });


          }                       

          return $notes;
    }

    public static function notes() {
     
      $notes = Asset::PublishedNotes()->paginate();

      return Asset::loadNotesTags($notes);
     
    }


}
