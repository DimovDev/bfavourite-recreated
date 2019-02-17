<?php 

namespace App\Helpers\Menu;

use App\Helpers\Menu\Link;

  interface LinkGroup {

    public function hasItem(Link $item) : int;
    public function hasItems() : bool;
    public function getItem(int $index) : Link;
  

    public function add(Link $item) : LinkGroup;
    public function remove(Link $item) : LinkGroup;
    public function removeByIndex(int $index) : Link;

    public function reset() : LinkGroup;

}