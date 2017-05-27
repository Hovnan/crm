<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'post',
        'address',
        'dob',
        'social',
        'designation',
        'working',
        'holiday',
        'hospital',
        'schedule',
        'branch_id',
        'salary'
    ];

    protected $dates = ['dob'];

    public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }

    public function timetables ()
    {
        return $this->hasManyThrough('App\Timetable', 'App\Training');
    }

    public function trainings ()
    {
        return $this->belongsToMany('App\Training');
    }

    public function getSocialAttribute($days)
    {
        return $days ? json_decode($days, true) : [];
    }

    public function setSocialAttribute(array $days)
    {
        $this->attributes['social'] = $days ? json_encode($days) : '';
    }
}
