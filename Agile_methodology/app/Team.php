<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_teams', 'team_id', 'user_id')
            ->withPivot('relation')->withTimestamps();
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'questionnaires_team', 'team_id', 'questionnaire_id');
    }

    public function projects(){
        return $this->hasMany(Project::class,'team_id');
    }
}
