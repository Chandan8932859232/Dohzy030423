<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckProfileComplete
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
        if(!(new \App\Models\User)->isUserProfileComplete()){
            return redirect()->route('register.complete.intro')
                              ->with('warning', __('please complete your profile before applying for a loan'));
        }

        return $next($request);
    }
}
