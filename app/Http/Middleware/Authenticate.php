<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected $guards = [];
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */



    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->segment(1) === 'waiter')
            {
                return redirect('/waiter/');
            }
            else{
                return route('login');
            }
        }
    }
}
