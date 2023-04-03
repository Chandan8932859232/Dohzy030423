<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
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
        if (session()->has('locale')) {  //checking if a session value exists with name locale
            App::setLocale(session()->get('locale'));  //if so we are setting the locale of our application with whatever that is in that session.
        }
        return $next($request);
    }
}
