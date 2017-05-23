<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Log;

class OwnersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Sentinel::getUser();
        
        //if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'owner')
        //if(Sentinel::check() && $user->role[$user->id] == 'owner')
        if(Sentinel::check() && $user->companies()->where('user_id', $user->id)->first())
        {
            //Sentinel::check() go AuthMiddleware
            //if($user->companies()->where('user_id', $user->id)->first())
           // Log::info('role', ['role' => Sentinel::getUser()->roles()->first()->slug]);
            return $next($request);
        }
        else
        {
            return redirect('/');
        }

    }
}
