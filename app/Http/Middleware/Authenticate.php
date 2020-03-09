<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {

//        if (! $request->expectsJson()) {
//            if (auth('admin')->check()){
//                return redirect()->route('login');
//            }elseif(auth('hr')->check()){
//                return redirect()->route('hrLogin');
//            }
//        }
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
}
