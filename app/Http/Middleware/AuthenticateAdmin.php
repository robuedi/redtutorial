<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AuthenticateAdmin
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
        if (Sentinel::check() && (Sentinel::hasAccess('admin'))) {
            return $next($request);
        }

        return redirect('/admin')->withErrors(['You must be logged in as admin.']);
    }
}
