<?php

namespace App\Http\Middleware;

use Closure;

class PhoneVerified
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
        if(auth()->check() && auth()->user()->is_verified == 0)
        {
            return redirect('/verify-otp');
        }
        return $next($request);
    }
}
