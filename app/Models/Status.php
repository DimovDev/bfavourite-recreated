<?php

namespace App\Models;

class Status
{
    protected $statuses = ['not active', 'active'];

    public function all() {

        return $this->statuses;
        
    }
}
