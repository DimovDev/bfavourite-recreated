<?php 

namespace App\Helpers\Menu;

use App\Helpers\Menu\{MenuLink, LinkGroup, LinkGroupItem};
use App\Helpers\Menu\Exceptions\{ItemNotFoundException, NoItemsException};

abstract class MenuLinkComponent implements MenuLink, LinkGroup, LinkGroupItem, \Iterator {

   protected $position = 0;
   protected $items = [];

   protected $url;
   protected $link_text;
   protected $active;
   protected $id;

   protected $icon;

   protected $parent; 

   public function __construct($data = []) {

     if(isset($data['url'])) $this->setUrl($data['url']);
     if(isset($data['text'])) $this->setText($data['text']);


    }

    public function setId(string $id) : Link {

        $this->id = $id;

        return $this;
    }

    public function getId() : string {
          
        if(!$this->id) $this->setId(str_replace('.', '-', uniqid('menulink', true)));

        return $this->id;

    }
   
    public function first() : MenuLinkComponent {

        if(isset($this->items[0])) return $this->items[0];

        throw new NoItemsException('There aren\'t any items');
    }

    public function last() : MenuLinkComponent {

        $index = count($this->items)-1;
        if(isset($this->items[$index])) return $this->items[$index];

        throw new NoItemsException('There aren\'t any items');
    }

    public function length(bool $deep = false) : int {

        $count = count($this->items);
        $items = $this->items;
        
        if($deep && $count) {

            foreach($items as $item) {
                   
             $count += $item->length(true);

            }

        }

        return $count;
 
    }


    public function findByUrl(string $url, bool $deep = false) : ?Link {
        
        $items = $this->items;
 
        foreach ($this->items AS $item) {
            
            

            if($item->getUrl() == $url) return $item;
        
            if($deep && $item->hasItems()) {
                
              
                
                foreach($item AS $child_item) {

                    if($child_item->getUrl() == $url) {
        
                        return $child_item;

                    }

                    $found = $child_item->findByUrl($url, true);

                    if($found) return $found;
                }
            }
        }
      

        return null;
    
    }
 
    public function findByText(string $text, bool $deep = false) : ?Link {


        $items = $this->items;

        foreach ($this->items AS $item) {

            if($item->getText() == $text) return $item;


            if($deep && $item->hasItems()) {
                
                foreach($item AS $child_item) {

                    if($child_item->getText() == $text) {
        
                        return $child_item;

                    }

                    $found = $child_item->findByText($text, true);

                    if($found) return $found;
                }
            }
        }

        return null;
    
    }

   

    public function hasItem(Link $checkedItem) : int {
            
        foreach($this->items AS $key => $item) {
          
            if($item == $checkedItem) return $key;

        }

        return -1;

    }


    public function hasItems() : bool {
        
        return !empty($this->items);

    }

    public function getItem(int $index) : Link {
         
        if(!isset($this->items[$index])) throw new \OutOfRangeException('There is no such item.');

        return $this->items[$index];

    }


    public function add(Link $item, bool $setParent = true) : LinkGroup {

        $this->items[] = $item;
        if($setParent) $item->setParent($this);

        return $this;

    }

    public function remove(Link $removedItem) : LinkGroup {
        
        $items = array_filter($this->items, function($item) use ($removedItem) {
            return $item != $removedItem;                       
         });

        if($this->items == $items) throw new ItemNotFoundException('The item cannot be removed.');

        return $this;
    }

    public function removeByIndex(int $index) : Link {

        if(!isset($this->items[$index])) throw new ItemNotFoundException('The item cannot be removed.');

        $item = $this->items[$index];
        unset($this->items[$index]);

        return $item;
    }


    public function reset() : LinkGroup {

        $this->items = [];
        $this->rewind();

        return $this;
    }


    public function hasParent() : bool {

        return !empty($this->parent);
    }

    public function setParent(LinkGroup $linkGroup) : LinkGroupItem {

        $this->parent = $linkGroup;

        if($this->parent->hasItem($this) == -1) $this->parent->add($this);

        return $this;
    }

    public function getParent() : ?LinkGroup {

        return $this->parent;
    }

    public function setUrl(string $url) : Link {

        $this->url = $url;
        return $this;
    }

    public function setText(string $text) : Link {

        $this->link_text = $text;
        return $this;
    }

    public function getUrl() : ?string {

        return $this->url;
    }

    public function getText() : string {

        return $this->link_text;
    }

    
    public function setActive(bool $active) : Link {

        $this->active = $active;
        return $this;
    }

    public function getActive() : bool {

        return (bool) $this->active;

    }


    public function setIcon(string $icon) : MenuLink {

        $this->icon = $icon;
        return $this;
     
     }
     
     public function getIcon() : ?string {
       
         return $this->icon;
     } 

   public function current() {

      return $this->items[$this->position];

   }

   public function key() : int {
      
     return $this->position;

   }

   public function next() : void {

        ++$this->position;
   }

   
   public function rewind() : void {

     $this->position = 0;
   }

   public function valid() : bool {

    return isset($this->items[$this->position]);

   }

}