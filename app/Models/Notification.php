<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';
    public function notification_to(){
        return $this->belongsTo('App\Models\User','notification_for','id');
    }
	public function notification_from(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
	public function notification_post(){
        return $this->belongsTo('App\Models\Post','parent_id','post_id');
    }
    public function comments(){
        return $this->belongsTo('App\Models\Comment','id','source_id');
    }
    public function likes(){
        return $this->belongsTo('App\Models\Like','id','source_id');
    }
}