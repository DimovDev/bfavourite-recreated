<?php 

namespace App\Helpers\Menu\Builder;

use App\Helpers\Menu\Link;

class BuilderCache {

   protected $cached = [];

   public function add(string $key, Link $link) : BuilderCache {
          
       $this->cached[$key] = $link;
       return $this;
   } 

   public function remove(string $key) : ?Link {

      if(isset($this->cached[$key])) {
        
        $link = $this->cached[$key];
        unset($this->cached[$key]);
        return $link;
      }  

      return null;

   }

   public function removeByLink(Link $link) : void {
      
      $this->cached = array_filter($this->cached, function($l) use ($link) {
 
                                                      return $l != $link;
                                                      
                                                  });

   }

   public function find(string $key) : ?Link {
      
      if(isset($this->cached[$key])) return $this->cached[$key];

      return null;

   }

}