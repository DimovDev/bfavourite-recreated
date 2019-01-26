<?php

namespace App;

class UserRole
{
    
   protected $roles = ['subscriber', 'admin'];

   public function all() {

     return $this->roles;

   }

}
