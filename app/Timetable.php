<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = [
        'day',
        'time',
        'training_id',
        'employee_id'
    ];
    /*
    public function branches ()
    {
        return $this->hasManyThrough('App\Training', 'App\Employee');
    }*/

    public function trainings ()
    {
        return $this->belongsTo('App\Training', 'training_id');
    }

    public function employees ()
    {
        return $this->belongsTo('App\Employee');
    }

    public function getDayAttribute($days)
    {
        return $days ? json_decode($days, true) : [];
    }

    public function setDayAttribute(array $days)
    {
        $this->attributes['day'] = $days ? json_encode($days) : '';
    }
}
