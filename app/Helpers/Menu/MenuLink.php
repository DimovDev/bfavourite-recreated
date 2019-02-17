<?php 

namespace App\Helpers\Menu;

use App\Helpers\Menu\Link;

interface MenuLink extends Link {

    public function getIcon() : ?string; 
    public function setIcon(string $icon) : MenuLink;

}