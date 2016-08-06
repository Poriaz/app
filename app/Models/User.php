<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    public function Addedbyme(){
        return $this->hasOne('App\Models\Associate','request_to','id');
    }
    
    public function Addedme(){
        return $this->hasOne('App\Models\Associate','request_from','id');
    }
    
    public function followers(){
        return $this->hasMany('App\Models\Follower','request_from','id');
    }
   
    public function following(){
        return $this->hasMany('App\Models\Follower','request_to','id');
    }
    
    public function mefollowing(){
        return $this->hasOne('App\Models\Follower','request_to','id');
    }
}