<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class ManagersMiddleware
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
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'manager')
        {
            // Log::info('role', ['role' => Sentinel::getUser()->roles()->first()->slug]);
            return $next($request);
        }
        else
        {
            return redirect('/');
        }
    }
}
