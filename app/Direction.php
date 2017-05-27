<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $fillable = [
        'name',
        'branch_id'
    ];

    public function branch ()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function trainings ()
    {
        return $this->hasMany('App\Training');
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
