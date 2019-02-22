<?php

namespace App\Models\Asset;

use App\Models\Asset\Asset;
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

}
