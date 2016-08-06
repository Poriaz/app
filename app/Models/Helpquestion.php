<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Helpquestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'help_questions';
    public function category(){
       return $this->belongsTo('App\Models\Helpquestioncategory','cat_id','id');
    }
}