<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
		if(Auth::user()->role == 1){
			return $next($request);
		}else{
			if ($request->ajax() || $request->wantsJson()) {
					return response('Unauthorized.', 401);
				} else {
					return redirect('/');
				}
		}
    }
}