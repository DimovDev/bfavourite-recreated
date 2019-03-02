<?php

namespace App\Helpers;

use App\Helpers\CollectionHelper;

class MetaTagHelper extends CollectionHelper {
 

  public function push(string $name, string $content, array $attributes = null) {

    $this->items[] = ['name' => $name,
                     'content' => $content,
                     'attributes' => $attributes];

    return $this;                 

  }

  public function unshift(string $name, string $content, array $attributes = null) {
     
    array_unshift($this->items, ['name' => $tagName,
                                'content' => $content,
                                'attributes' => $attributes]);

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