<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'domain',
        'user_id'
    ];
    //???
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //???
    public function branches () 
    {
        return $this->hasMany('App\Branch');
    }
    public function customers ()
    {
        return $this->hasManyThrough('App\Customer', 'App\Branch');
    }
}
