<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'child_subscriber';
    
    protected $fillable = [
        'number',
        'remainder',
        'paid',
        'child_id',
        'subscriber_id',
        'valid',
    ];
    protected $dates = ['valid', 'last_visit'];
   // protected $dates = ['date'];
    //protected $dateFormat = 'd.m.Y';

    public function childs ()
    {
        return $this->belongsTo('App\Child');
    }

    public function subscriber ()
    {
        return $this->belongsTo('App\Subscriber');
    }
/*
    public function getLast_visitAttribute($l_v)
    {
        return $l_v->format('d.m.Y');
    }*/
    
}
