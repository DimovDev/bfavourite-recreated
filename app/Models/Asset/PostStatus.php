<?php

namespace App\Models\Asset;

use App\Models\Status;

class PostStatus extends Status
{
    protected $statuses = ['draft', 'publish'];
    protected $system_statuses = ['future'];

    public function system() {

       return $this->system_statuses; 
    }

    public function all($with_system_statuses = false) {

        return !$with_system_statuses ? parent::all() : array_merge($this->statuses, $this->system_statuses);
    } 
}


