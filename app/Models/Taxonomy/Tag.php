<?php

namespace App\Models\Taxonomy;

use App\Models\Asset\Note;
use App\Models\Asset\Asset;
use App\Models\Taxonomy\Taxonomy;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Tag extends Taxonomy
{
    
    protected $table = 'taxonomies';

    protected $fillable = ['name', 'slug', 'taxonomy_status', 'taxonomy_type', 'icon_id', 'summary', 'asset_id'];

    protected $attributes = [
        
        'taxonomy_type' => 'tag'

    ];
  


    public static function boot() {

        parent::boot();

        static::addGlobalScope('taxonomy_type', function(Builder $builder) {

           $builder->where('taxonomy_type', 'tag');

        });

    }

    public function delete() {

        $this->notes()->detach();

        $result = parent::delete();
  
        return $result;
   
      }

        /*
     * Get all posts of the tag
     */
     
    public function posts() {

        return $this->morphedByMany('App\Models\Asset\Post', 'obj', 'taxonomy_object', 'taxonomy_id');
     }  

         /*
     * Get all projects of the tag
     */
     
    public function projects() {

        return $this->morphedByMany('App\Models\Asset\Project', 'obj', 'taxonomy_object', 'taxonomy_id');
     }  


   /* 
    * Get the tags of the tags 
    */

    public function tags() {

        return $this->morphToMany('App\Models\Taxonomy\Tag', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id')->withPivot('base_type');
  
      }

     
    /*
     * Get the assigned content piece 
     */

    public function asset() {

        return $this->belongsTo('App\Models\Asset\Asset');
    }


    public function scopeActive($query) {

        return $query->where('taxonomy_status', 'active');
    }

    public function notes() {

        return $this->morphedByMany('App\Models\Asset\Note', 'base', 'taxonomy_object', 'taxonomy_id', 'obj_id');

   }

   public function scopeTechs($query, $count) {

       $query->join('taxonomy_object', function ($join) {
          
          $join->on('obj_id', '=', 'taxonomies.id');
          $join->on('obj_type', '=', 'taxonomy_type');

       })->where('taxonomy_status', 'active')
         ->where('taxonomy_id', 41)
         ->take($count);

   }


    public static function notesWithTags(array $tag_ids) {

        $tag_id = (int) array_shift($tag_ids);

        $notes = Note::published()
                      ->select('assets.*')
                      ->join('taxonomy_object AS to', function($join){
                          $join->on('assets.id', '=', 'to.obj_id');
                          $join->on('assets.asset_type', '=', 'to.obj_type');
                      })
                      ->where('to.taxonomy_id', $tag_id);

        foreach ($tag_ids AS $tag) {
           $tag = (int) $tag;
           $notes->whereRaw("(SELECT COUNT(to{$tag}.id) FROM taxonomy_object as to{$tag}
                              WHERE to{$tag}.taxonomy_id = $tag
                              AND to{$tag}.obj_id = assets.id 
                              AND to{$tag}.obj_type = assets.asset_type) > 0");
        
        }

/*         $query = "SELECT assets.* FROM assets 
                  INNER JOIN taxonomy_object as to1 
                  ON assets.id = to1.obj_id 
                  AND assets.asset_type = to1.obj_type 
                  WHERE taxonomy_id = $tag_id
                  AND assets.asset_status = 'publish'
                  AND published_at <= '".date('Y-m-d h:i:s')."'";

        foreach ($tag_ids AS $tag) {
          
          $tag = (int) $tag;

          $query .= " AND (SELECT COUNT(to{$tag}.id) FROM taxonomy_object as to{$tag}
                          WHERE to{$tag}.taxonomy_id = $tag
                          AND to{$tag}.obj_id = assets.id 
                          AND to{$tag}.obj_type = assets.asset_type) > 0";

        }
                  

         $r = DB::select(DB::raw($query)); */
         
         return $notes;
       
      }
    

}
