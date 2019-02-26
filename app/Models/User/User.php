<?php

namespace App\Models\User;

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
        'name', 'email', 'password', 'role', 'user_status', 'photo_id'
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

        return $this->belongsTo('App\Models\Media\Media', 'photo_id');
        
     }

    /*
     * Get all posts of the user
     */
     
     public function posts() {

        return $this->morphedByMany('App\Models\Asset\Post', 'obj', 'user_object');
     }  

         /*
     * Get all projects of the user
     */
     
    public function projects() {

        return $this->morphedByMany('App\Models\Asset\Project', 'obj', 'user_object');
     }  

         /*
     * Get all tags of the user
     */
     
    public function tags() {

        return $this->morphedByMany('App\Models\Taxonomy\Tag', 'obj', 'user_object');
     }  
}
