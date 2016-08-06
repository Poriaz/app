<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likes';
    public function owner(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function post(){
        return $this->belongsTo('App\Models\Post','post_id');
    }
}