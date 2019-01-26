<?php

namespace App;

use App\Status;


class PostStatus extends Status
{
    protected $statuses = ['draft', 'publish'];
    protected $system_statuses = ['future'];

    public function system() {

       return $this->system_statuses; 
    }

    public function all($with_sys = false) {

        return !$with_sys ? parent::all() : array_merge($this->statuses, $this->system_statuses);
    } 
}


