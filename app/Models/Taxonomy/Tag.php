<?php

namespace App\Models\Taxonomy;

use App\Models\Asset\Asset;
use App\Models\Taxonomy\Taxonomy;
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

        return $this->morphToMany('App\Models\Taxonomy\Tag', 'obj', 'taxonomy_object', 'obj_id', 'taxonomy_id');
  
      }

     
    /*
     * Get the assigned content piece 
     */

    public function asset() {

        return $this->belongsTo('App\Models\Asset\Asset');
    }


    public static function notes(array $tag_ids) {

        $tag_id = array_shift($tag_ids);

        $notes = Asset::PublishedNotes()
                       ->rightJoin('taxonomy_object', function($join) {
                          
                          $join->on('obj_id', '=', 'assets.id')
                               ->on('obj_type', '=', 'assets.asset_type');

                       })
                       ->select('assets.*')
                       ->where('taxonomy_id', $tag_id)
                       ->with('tags')
                       ->paginate();

        $notes = $notes->unique('id');       
        

  
        $notes = Asset::loadNotesTags($notes);

        if(count($tag_ids) > 0) {  

            $notes = $notes->filter(function($note, $key) use ($tag_ids) {
                
                $tags = $note->tags;
   
                foreach($tag_ids AS $id) {
                    
                  if(!$tags->where('id', $id)->first()) return;
                   
                }
              
                return true;
   
            });
        }
   
          return $notes;
       
      }
    

}
