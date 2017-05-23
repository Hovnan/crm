<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'when',
        'coment',
        'branch_id'
    ];

    public function branches ()
    {
        return $this->belongsTo('App\Branch');
    }
}
