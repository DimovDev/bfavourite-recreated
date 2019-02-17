<?php 

namespace App\Helpers\Menu;

use Illuminate\View\Factory as LaravelView;
use App\Helpers\Menu\{View, MenuLinkGroup};


Class LaravelMenuView implements View {
   
  protected $view;
  protected $links;

  protected $path;

  public function __construct(LaravelView $view) {

    $this->view = $view;

  }

  public function setTemplatePath(string $path)  : View {

    $this->path = $path;
    return $this;
  }

  public function getTemplatePath() : string {

    return $this->path;
  }

  public function loadLinks(?MenuLinkComponent $links) : View {

    $this->links = $links;
    return $this;

  }

  public function getLinks() : MenuLinkComponent {

    return $this->links;

  }

  public function resetLinks() : View {

    $this->links = null;

    return $this;
  }

  public function render(string $path = null) : string {
      
     if($path) $this->setTemplatePath($path);

     return $this->view->make($this->path)->with('menu', $this->links)->render();

  }




} 