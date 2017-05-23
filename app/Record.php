<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'invitation_id',
        'branch_id',
        'role',
        'permissions'
    ];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }
    public function branch ()
    {
        return $this->belongsTo('App\Branch');
    }
    /*public function company ()
    {
        return $this->hasManyThrough('App\Branch', 'App\Company');
    }*/

    public function getPermissionsAttribute($permissions)
    {
        return $permissions ? json_decode($permissions, true) : [];
    }

    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }
}
