<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'age',
        'amount',
        'cost',
        'direction_id'
    ];
    // must change
    /*
     public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }
     * */
    public function direction ()
    {
        return $this->belongsTo('App\Direction');
    }
    /*
    public function branches ()
    {
        return $this->hasManyThrough('App\Branch', 'App\Direction');
    }*/

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }/*
    public function getDaysAttribute($days)
    {
        return $days ? json_decode($days, true) : [];
    }

    public function setDaysAttribute(array $days)
    {
        $this->attributes['days'] = $days ? json_encode($days) : '';
    }*/
}
