<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceModeHandler
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
        if (filter_var(settings('maintenance_status'), FILTER_VALIDATE_BOOLEAN)) {
            return redirect(route('maintenance'));
        }
        return $next($request);
    }
}
