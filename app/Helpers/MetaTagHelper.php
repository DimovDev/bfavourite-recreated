<?php

namespace App\Helpers;

use App\Helpers\CollectionHelper;

class MetaTagHelper extends CollectionHelper {
   
  public function set(string $name, string $content) {

    $items = array_filter($this->items, function($item) use ($name) {
                
        return $name == $item['name'];
       
    });

   

    if(!empty($items)) {

      $items = array_keys($items);

      
      $this->remove($items[0]);

      $this->push($name, $content);

    } 

  }

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
   
    if(isset($this->items[$index])) {

        $item = $this->items[$index];
        unset($this->items[$index]);
        $this->items = array_values($this->items);

        return $item;
    }

    return null;
    
  }

}