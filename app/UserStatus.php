<?php

namespace App;


class UserStatus
{
    public $statuses = ['not active', 'active'];

    public function all() {

        return $this->statuses;
        
    }


}
