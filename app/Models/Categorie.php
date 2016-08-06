<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public function post(){
        return $this->hasMany('App\Models\Post','post_id');
    }
}