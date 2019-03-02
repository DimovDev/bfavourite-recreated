<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPivot extends Model
{
    protected $table = "user_object";

    public function scopeWithData($query) {
         
      return  $query->join('users', 'user_id', '=', 'users.id')
                    ->addSeclect('users.*');

   }
}
    

