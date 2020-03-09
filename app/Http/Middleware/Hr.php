<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class Hr
{

    protected $redirectTo = 'hr/dashboard';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'hr')
    {

        if (Auth::guard($guard)->check()) {
            return redirect()->route('hr.home');
        }
        return $next($request);
    }
}
