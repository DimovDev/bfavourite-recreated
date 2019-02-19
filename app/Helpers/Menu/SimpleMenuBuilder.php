<?php

namespace App\Helpers\Menu;

use Illuminate\View\Factory as LaravelView;

use App\Helpers\Menu\{MenulinkSingle, MenuLinkGroup, LaravelMenuView};
use App\Helpers\Menu\Builder\BuilderCache;

class SimpleMenuBuilder {

    protected $menu_collection;
    protected $view;

    protected $chain = [];

    protected $cache;

    protected $current; 

    public function __construct(LaravelView $view) {

      $this->view = new LaravelMenuView($view);
      $this->menu_collection = new MenuLinkGroup();
      $this->current = $this->menu_collection;

      $this->cache = new BuilderCache();
    
    }



    public function make($data) : SimpleMenuBuilder {

       $this->chain[] = function() use ($data) {
                              $this->current->add(new MenuLinkGroup($data));
                           };

       return $this;

    }

    public function add(string $text, string $url = null) : SimpleMenuBuilder {
      
      $data = ['text' => $text];
      if($url) $data['url'] = $url;

      $this->chain[] = function() use ($data) {

                             $link = new MenuLinkGroup($data);
                             $this->cache->add($data['text'], $link);
                             $this->current->add($link);

                          };

      return $this;

    }

    public function first() : MenuLinkGroup {

      $current = $this->runAndClear();

      return $current->first();

    }   

    public function last() : MenuLinkGroup {

      $current = $this->runAndClear();

       return $current->last();

    }

    public function find($text) : SimpleMenuBuilder  {

      $this->chain[] = function() use ($text) {

        if($cached = $this->cache->find($text)) {
           
           $this->current = $cached;

        } else {

          $this->current = $this->menu_collection->findByText($text, true);
          if($this->current) $this->cache->add($text, $this->current);

        } 

      };
       
      return $this;

    }

    public function findByUrl(string $url) {

      $this->chain[] = function() use ($url) {
        
        if($cached = $this->cache->find($url)) {
          
           $this->current = $cached;

        } else {

         $this->current = $this->menu_collection->findByUrl($url, true);
         if($this->current) $this->cache->add($url, $this->current);

        }

      };   

       
       return $this;
    }

    public function exists() : bool {
      
      $current = $this->runAndClear();

      return (bool) $current;

      

    }

    public function clear() : SimpleMenuBuilder {
       
       $this->current = $this->menu_collection;
       $this->chain = [];

       return $this;

    }

    public function get() : MenuLinkGroup {
    
      $current = $this->runAndClear();

      return $current;

    }

    public function remove() {


      $this->chain[] = function() {

        if($this->current != $this->menu_collection) {
        
          $item = $this->current;
          $this->cache->removeByLink($this->current);


          $this->current = $this->menu_collection;
  
          $item->getParent()->remove($item);
  
          return $this;
  
        } 
  
        throw new Exception('Can\'t remove the menu itself.');

      };   
       
       return $this;
      
    }



    public function setActive(bool $active, bool $parentsAlso = false) : SimpleMenuBuilder {

      $this->chain[] = function() use ($active, $parentsAlso) {
   
          $item = $this->current;

          $item->setActive($active);

          while($parentsAlso && $item) {

            $item->setActive($active);
            $item = $item->getParent();

          }

      };   


       return $this;

    }


    public function isActive() : bool {

      $current = $this->runAndClear();

      return (bool) $current->getActive();
    }

    public function setIcon($icon) : SimpleMenuBuilder {

      $this->chain[] = function() use ($icon) {

        $this->current->setIcon($icon);

      };   
      
      return $this;
    }

    public function getIcon() : string {
      
      $current = $this->runAndClear();

      return $current->getIcon();

    }


    public function getUrl() : string {

      $current = $this->runAndClear();

      return $current->getUrl();
    }

    public function setUrl(string $url) : SimpleMenuBuilder {
      
      $this->chain[] = function() use ($url) {

        $this->current->setUrl($url);

      };   
      
      return $this;

    }

    public function setText(string $text) : SimpleMenuBuilder {

     $this->chain[] = function() use ($url) {

        $this->current->setUrl($url);

      };   

      return $this;
    }

    public function getText() : string {

      $current = $this->runAndClear();

      return $current->getText();
    }

    public function parent() : SimpleMenuBuilder {


      $this->chain[] = function() use ($url) {

        if($this->current != $this->menu_collection) {
   
          $this->current = $this->current->getParent();
  
          return $this;
  
        } 
  
        throw new Exception('The builder itself doesn\'t have a parent.');

      };   

      return $this;
    }

    public function render(string $template = null) : string {
      
      $current = $this->runAndClear();
    
      $this->view->loadLinks($current);

      return $this->view->render($template);

    }


   public function execute() {
      
      $this->runAndClear();
      
      return $this;
    }
    
    protected function run() : void {
         
      foreach($this->chain AS $command) {

        $command();

      }

    }

    protected function runAndClear() : ?MenuLinkGroup {

       $this->run();
       $item = $this->current;
       $this->clear();

       return $item;

    }


}

