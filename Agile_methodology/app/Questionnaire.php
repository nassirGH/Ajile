<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'questionnaires_team', 'questionnaire_id', 'team_id');

    }

    public function questions(){
        return $this->hasMany(Question::class,'questionnaire_id');
    }
    public function users(){
        return $this->belongsToMany(User::class,'questionnaire_user','questionnaire_id','user_id')->withPivot(['comment'])->withTimestamps();

    }
}
