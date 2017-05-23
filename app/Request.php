<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'name',
        'post',
        'phone',
        'coment',
        'branch_id'
    ];

    public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }
}
