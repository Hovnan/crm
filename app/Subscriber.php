<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'subscribers';
    protected $fillable = [
        'type',
        'name',
        'price',
        'visits',
        'validity',
        'freeze',
        'branch_id'
    ];
    //protected $dates = ['validity'];

    public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }

    public function childs ()
    {
        return $this->belongsToMany('App\Child');
    }

    public function trainings ()
    {
        return $this->belongsToMany('App\Training');
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    /*public function getValidityAttribute($validity)
    {
        return date($validity);
    }*/
    
}
