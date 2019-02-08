<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'user_status', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getStatusAttribute($value) {

        return $this->user_status;
    }

    /*
     * Get the user's photo
     */

    public function photo() {

        return $this->belongsTo('App\Media', 'photo');
        
     }

    /*
     * Get all posts of the user
     */
     
     public function posts() {

        return $this->morphedByMany('App\Post', 'obj', 'user_object');
     }  

         /*
     * Get all projects of the user
     */
     
    public function projects() {

        return $this->morphedByMany('App\Project', 'obj', 'user_object');
     }  

         /*
     * Get all categories of the user
     */
     
    public function categories() {

        return $this->morphedByMany('App\Category', 'obj', 'user_object');
     }  
}
