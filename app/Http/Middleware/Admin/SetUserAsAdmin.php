<?php

namespace App\Http\Middleware\Admin;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;

class SetUserAsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        config()->set('auth.defaults.guard','admin');

        Auth::shouldUse('admin');
        return $next($request);
    }
}
