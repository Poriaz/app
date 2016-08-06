<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'followers';
    public function followers(){
        return $this->belongsTo('App\Models\User','request_from','id');
    }
    public function following(){
        return $this->belongsTo('App\Models\User','request_to','id');
    }
    
}