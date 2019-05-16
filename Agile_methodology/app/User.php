<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'username','parent_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }
    public function isAdminOrCoach()
    {
        return $this->role == 'admin' || $this->role == 'coach';
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'users_teams', 'user_id', 'team_id')
            ->withPivot('relation')->withTimestamps();
    }

    public function questions(){
        return $this->belongsToMany(Question::class,'questions_users','user_id','question_id')->withPivot(['rate'])->withTimestamps();

    }
    public function questionnaires(){
        return $this->belongsToMany(Questionnaire::class,'questionnaire_user','users_id','questionnaire_id')->withPivot(['comment'])->withTimestamps();

    }
}
