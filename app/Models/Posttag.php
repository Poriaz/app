<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Posttag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tags';
	public function tags()
    {
        return $this->belongsTo('App\Models\Post','post_id','post_id');
    }
}