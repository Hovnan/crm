<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invitation extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];
    
    public static function byEmail($email)
    {
        return static::whereEmail($email)->first();
    }

    public function informations ()
    {
        return $this->hasMany('App\Information');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
