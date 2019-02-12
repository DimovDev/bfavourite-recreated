<?php

namespace App;

use App\Asset;
use Illuminate\Database\Eloquent\Builder;

class Project extends Asset
{
    protected $attributes = ['asset_type' => 'project'];


    protected $table = "assets";

    public static function boot() {

      parent::boot();

      static::addGlobalScope('asset_type', function(Builder $builder) {

         $builder->where('asset_type', 'project');

      });

  }

    public static function create(array $data = []) {
       
        $project =  static::query()->create($data);

        if($project->id && !empty($data['meta'])) {
         
           foreach($data['meta'] as $key => $value ) {

            if($value) $project->assetsMeta()->create(['asset_id' => $project->id,
                                                       'meta_key' => $key,
                                                       'meta_value' => $value]); 

           }
        }
    
     return $project;
   }

   public function update(array $data = [], array $options = []) {

      $result = parent::update($data);
      
      if(isset($data['meta'])) {
  
         if(!empty($data['meta'])) {

         $db = $this->assetsMeta();
            
         foreach($data['meta'] as $key => $value ) {
           
            
           
          if($value) {
           
            
                  $db->firstOrcreate(['asset_id' => $this->id,
                                      'meta_key' => $key],
                                     ['meta_value' => $value]); 
          } else {
           
            $this->assetsMeta()->where('meta_key', $key)->delete();
          }

         

         }

       }
     }

       
     return $result;

   }

   /**
     * Get the meta fields for the project asset.
    */

   public function assetsMeta() {

      return $this->hasMany('App\AssetMeta', 'asset_id');

   }

   public function getMeta($key) {

       $result = $this->assetsMeta()->where('meta_key', $key);

       if($result->count()) return $result->first()->meta_value;

   }

       /* 
        * Get the owner of the project 
        */

       public function user() {

         return $this->morphToMany('App\User', 'obj', 'user_object');
   
       }

       
   /* 
    * Get the categories of the post 
    */

    public function categories() {

      return $this->morphToMany('App\Category', 'obj', 'taxonomy_object', null, 'taxonomy_id');

    }


}
