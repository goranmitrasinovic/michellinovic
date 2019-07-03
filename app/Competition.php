<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sport',
        'icon',
        'score_home',
        'score_away',
    ];

    public function users(){
        return $this->belongsToMany('App/User', 'competition_user', 'competition_id', 'user_one_id', 'user_two_id');
    }
}
