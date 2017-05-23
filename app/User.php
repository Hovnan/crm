<?php

namespace App;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;
//class User extends Authenticatable

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'name', 'email', 'password',
        'email',
        'password',
        //'role',
        'last_name',
        'first_name',
        'permissions',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function byEmail($email)
    {
        return static::whereEmail($email)->first();
    }
    /*public function setRoleAttribute($value)
    {
        $this->attributes['role'] = json_encode($value);
    }*/
    /*public function getRoleAttribute($value)
    {
        return json_decode($value, true);
    }*/
    
    public function dMany($key)
    {
        //return dd($this->br);
        //if(array_key_exists($br_id, $this->permissions))
        //{
            return !array_key_exists($key, $this->permissions);
        //}
    }

    /*public function getPermissionsAttribute($value)
    {
        return json_decode($value, true);
    }
    */
    public function records()
    {
        return $this->hasMany('App\Record');
    }
    
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function confirmation()
    {
        return $this->hasOne('App\Confirmation');
    }
    
    //can remove
   /* public function branches ()
    {
        return $this->belongsToMany('App\Branch');
    }*/
    // end can remove
    
    /*public function branches ()
    {
        return $this->hasManyThrough('App\Branch', 'App\Company');
    }*/
}
