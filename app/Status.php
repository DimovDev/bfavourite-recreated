<?php

namespace App;

class Status
{
    protected $statuses = ['not active', 'active'];

    public function all() {

        return $this->statuses;
        
    }
}
