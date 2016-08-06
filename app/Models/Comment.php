<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';
    public function owner(){
        return $this->belongsTo('App\Models\User','author_id');
    }
    public function post(){
        return $this->belongsTo('App\Models\Post','post_id');
    }
}