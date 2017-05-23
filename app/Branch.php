<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'address',
        'company_id'
    ];

    /*public function users ()
    {
        return $this->belongsToMany('App\User');
    }*/
    public function employees ()
    {
        return $this->hasMany('App\Employee');
    }

    public function customers ()
    {
        return $this->hasMany('App\Customer');
    }
    
    public function childs ()
    {
        return $this->hasManyThrough('App\Child', 'App\Customer');
    }

    public function timetables ()
    {
        return $this->hasManyThrough('App\Timetable', 'App\Employee');
    }

     public function directions ()
    {
        return $this->hasMany('App\Direction');
    }
    
    public function trainings ()
    {
        return $this->hasManyThrough('App\Training', 'App\Direction');
    }

    //must change
    /*
    public function trainings ()
    {
        return $this->hasManyThrough('App\Training', 'App\Employee');
    }*/

    public function requests ()
    {
        return $this->hasMany('App\Request');
    }

    public function accountings ()
    {
        return $this->hasMany('App\Accounting');
    }

    public function subscribers ()
    {
        return $this->hasMany('App\Subscriber');
    }
    
    public function records()
    {
        return $this->hasMany('App\Record');
    }
    
    
    public function company ()
    {
        return $this->belongsTo('App\Company');
    }
    
}
