<?php

namespace App\Helpers;


abstract class CollectionHelper implements \Iterator {

    protected $items = [];
    protected $position = 0; 


    public function rewind() {
        
        $this->position = 0;
   
     }
   
     public function current() {
          
       return $this->items[$this->position];
   
     }
   
     public  function next() {
   
       ++$this->position;
   
     }
   
     public function key() {
   
       return $this->position;
   
     }
   
     public function valid() {
   
       return isset($this->items[$this->position]);
   
     }  
 
    
}