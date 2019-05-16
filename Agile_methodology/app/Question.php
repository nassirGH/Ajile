<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function questionnaire()
    {
        return $this->belongsTo(Question::class, 'questionnaire_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'questions_users','question_id','user_id')->withPivot(['rate'])->withTimestamps();
    }
}
