<?php

namespace App\Http\Middleware;

use Closure;

class CheckLoansWaitingList
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
        $userId = (new \App\Models\User)->getUserId();

        if((new \App\Models\User)->isUserOnLoansWaitingList($userId)) {

            return redirect()->route('waiting-list-block.note');
        }

           return $next($request);
    }
}
