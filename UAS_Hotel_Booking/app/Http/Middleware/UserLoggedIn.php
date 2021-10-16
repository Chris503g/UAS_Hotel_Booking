<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLoggedIn
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
        if(session()->has('LoggedAdmin'))
        {
            // Admin tidak boleh book hotel di home
            return redirect("/user")->with('alert', 'Admin cannot go to home page!');
        }
        else
        {
            // User login tidak dicek karena halaman home terbuka untuk umum
            return $next($request);    
        }
    }
}
