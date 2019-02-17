<?php 

namespace App\Helpers\Menu;

use App\Helpers\Menu\MenuLinkComponent;

interface View {

public function setTemplatePath(string $path) : View;
public function getTemplatePath() : string;

public function loadLinks(MenuLinkComponent $links) : View;
public function getLinks() : MenuLinkComponent;
public function resetLinks() : View;

public function render() : string;

}
