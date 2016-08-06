<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Helpquestioncategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'help_question_categories';
    public function helpquestions(){
        return $this->hasMany('App\Models\Helpquestion','category_id');
    }
}