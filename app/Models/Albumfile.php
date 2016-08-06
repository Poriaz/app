<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Albumfile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'album_files';
    public function album(){
        return $this->belongsTo('App\Models\Album','album_id');
    }
}