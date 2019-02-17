<?php 

namespace App\Helpers\Menu;

interface Link {

    public function getUrl() : ?string;
    public function setUrl(string $url) : Link;
   
    public function getText() : string;
    public function setText(string $text) : Link;
    
    public function getActive() : bool; 
    public function setActive(bool $active) : Link;

}
