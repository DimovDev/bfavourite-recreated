<?php 

namespace App\Helpers\Menu;

use App\Helpers\Menu\LinkGroup;

interface LinkGroupItem {

public function hasParent() : bool;
public function setParent(LinkGroup $linkGroup) : LinkGroupItem;
public function getParent() : ?LinkGroup;

public function hasItems() : bool; 


}