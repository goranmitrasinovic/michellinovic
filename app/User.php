<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function events(){
        return $this->belongsToMany('App/Event', 'event_user', 'event_id', 'user_one_id', 'user_two_id');
    }
}
