<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'childs';
    protected $fillable = [
        'child_name',
        'age',
        'gender',
        'customer_id'
    ];
    protected $dates = ['age'];
    
    public function customer ()
    {
        return $this->belongsTo('App\Customer');
    }

    public function subscribers ()
    {
        return $this->belongsToMany('App\Subscriber')->withTimestamps();

    }
    public function visits ()
    {
        return $this->hasMany('App\Visit');
    }
    public function numbers ()
    {
        return $this->hasMany('App\Numbers');
    }

}
