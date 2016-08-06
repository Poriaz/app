<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contactmessage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_us_messages';
    public function owner(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
}