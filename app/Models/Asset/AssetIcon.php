<?php

namespace App\Models\Asset;

class AssetIcon {
 
    protected $icons_map = ['default' => 'edit',
                            'post' => 'edit',
                            'project' => 'code',
                            'note' => 'sticky-note',
                            'photo' => 'image',
                            'link' => 'link'];


                            

    public function get(string $asset_type) : string {

         return isset($this->icons_map[$asset_type]) ? $this->icons_map[$asset_type] : $this->icons_map['default']; 

    }

}