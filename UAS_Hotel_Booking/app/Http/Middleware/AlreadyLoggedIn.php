<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('LoggedUser'))
        {
            return redirect('/');
        }
        else if(session()->has('LoggedAdmin'))
        {
            return redirect()->route('/user');
        }
        else
        {
            return $next($request);    
        }
    }
}
