<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        //redirect authenticated admin to admins homepage
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect()->route('admin.home');
        }


        //redirect authenticated investor to investor homepage
        if ($guard == "investor" && Auth::guard($guard)->check()) {
            return redirect()->route('investor.home');
        }

        //redirect authenticated user to user's homepage
        if (Auth::guard($guard)->check()) {
            return redirect()->route('user-dashboard');
        }



        return $next($request);
    }
}
