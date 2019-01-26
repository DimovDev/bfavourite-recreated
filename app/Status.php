<?php

namespace App;

class Status
{
    public $statuses = ['not active', 'active'];

    public function all() {

        return $this->statuses;
        
    }
}
