<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'post',
        'social',
        'branch_id'
    ];

    public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }

    public function childs ()
    {
        return $this->hasMany('App\Child');
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
