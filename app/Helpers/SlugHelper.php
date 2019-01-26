<?php 

namespace App\Helpers;

class SlugHelper {

  public static function generate($model_class, $value, $id = null) {

        $slug = str_slug($value, '-');

        $items = $model_class::where('slug', $slug)->orderBy('created_at', 'DESC')->get();
   
        if($items->count() && $id != $items->first()->id) {
  
          $items = $model_class::whereRAW('slug REGEXP ?', $slug.'[-0-9]{0,}$')->orderBy('created_at', 'ASC')->get();
       
          if($items->count()) {
  
              $last = $items->last();
           
              $last = explode('-', $last->slug);
              $last = (int) $last[count($last) - 1];
              $last++;
  
              $slug = $slug.'-'.$last;
  
  
          }
  
        }

        return $slug;
    }


}