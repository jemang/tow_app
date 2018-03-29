<?php

namespace App\Http\Middleware;

use Closure;


class AdminRight
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
        
		if (isset($request->user()->right) && $request->user()->usr_right< 2) {
            return redirect('/');
        }

        return $next($request);
    }
}
