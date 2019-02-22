<?php

namespace App\Models\User;

class UserRole
{
    
   protected $roles = ['subscriber', 'admin'];

   public function all() {

     return $this->roles;

   }

}
