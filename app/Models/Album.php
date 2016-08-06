<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';
    public function owner(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    
    public function files(){
        return $this->hasMany('App\Models\Albumfile','album_id');
    }
}