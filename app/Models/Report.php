<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reported_posts';
    public function post(){
        return $this->belongsTo('App\Models\Post','post_id','post_id');
    }
    public function owner(){
        return $this->hasOne('App\Models\User','id');
    }
}