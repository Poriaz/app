<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    public function images(){
        return $this->hasMany('App\Models\Postimage','post_id','post_id');
    }
    public function tags(){
        return $this->hasMany('App\Models\Posttag','post_id','post_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function comments(){
        return $this->hasMany('App\Models\Comment','post_id','post_id');
    }
    public function comments_count(){
        return $this->hasOne('App\Models\Comment','post_id','post_id')->selectRaw('post_id, count(*) as aggregate')->groupBy('post_id');
    }
    public function likes(){
        return $this->hasMany('App\Models\Like','post_id','post_id');
    }
	public function original_author(){
		return $this->belongsTo('App\Models\User','parent_post_user_id','id');
	}
	public function original_post(){
		return $this->hasOne('App\Models\Post','post_id','parent_id');
	}
}