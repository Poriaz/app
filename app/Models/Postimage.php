<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Postimage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
        protected $table = 'post_images';
	public function images()
        {
        return $this->belongsTo('App\Models\Post','post_id','post_id');
        }
}