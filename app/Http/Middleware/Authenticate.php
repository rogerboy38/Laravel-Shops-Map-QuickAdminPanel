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

        if (! $request->expectsJson()) {
            return route('login');
            //return dd($request);
        } else {
            // Force Json accept type
            if (! Str::contains($request->header('accept'), ['/json', '+json'])) {
                $request->headers->set('accept', 'application/json,' . $request->header('accept'));
            }
            return dd($request);
            return $next($request);
        }
    }

}
