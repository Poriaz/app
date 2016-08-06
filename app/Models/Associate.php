<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'associates';
    public function request_from(){
        return $this->belongsTo('App\Models\User','request_from','id');
    }
    public function request_to(){
        return $this->belongsTo('App\Models\User','request_to','id');
    }
    
}