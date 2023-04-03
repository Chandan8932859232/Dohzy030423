<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPayStub
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = (new \App\Models\User)->getUserId();

         $userType  =  (new \App\Models\User)->getUserType();


        if((new \App\Models\User)->isPayStubExceptionUser($userId)){

            return $next($request);

        }

        if($userType==1){ //if user type is 1 (user is normal user not a business user)

        //if pay stub is not provided
        if(!(new \App\Models\User)->userProvidedPayStub($userId) ){
            return redirect()->route('pay-stub.upload')
                              ->with('warning', __('please upload a pay stub as proof of employment'));
           }

        }



        return $next($request);
    }
}


