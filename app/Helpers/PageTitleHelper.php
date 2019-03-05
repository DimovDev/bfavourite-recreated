<?php 

namespace App\Helpers;

use App\Helpers\CollectionHelper;


class PageTitleHelper extends CollectionHelper {
    
    protected $delimiter;

    public function setDelimiter(string $delimiter) {

       $this->delimiter = $delimiter;
       return $this;

    }

    public function getDelimiter() {

        return $this->delimiter;

    }

    public function get() {

        return implode($this->delimiter, $this->items);
    }

    public function push(string $part) {

        $this->items[] = $part;
    
        return $this;                 
    
      }
    
      public function unshift(string $part) {
         
        array_unshift($this->items, $part);
    
        return $this;                 
    
      }

      public function pop() {

        return array_pop($this->items);
   
     }
   
   
     public function shift() {
           
        return array_shift($this->items);
   
     }   

    public function remove(int $index) : ?array {
       
        if(isset($this->item[$index])) {
    
            $item = $this->items[$index];
            unset($this->items[$index]);
    
            return $tag;
        }
        
      }     
    
    
}