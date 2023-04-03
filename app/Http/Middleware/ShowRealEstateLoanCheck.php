<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ShowRealEstateLoanCheck
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
        //if user is of type africa do not show them real estate form
        if((new \App\Models\User)->getUserType()== User::AFRICA_USER){
            return  redirect()->route('static-pages.index');
        }

        //if user dohzy score is less than 12,do not show them real estate assistance form
        if( (new \App\Models\User)->getUserScore() < 13 ){

            return redirect()->route('real-estate-form.block');

        }

        return $next($request);
    }
}
