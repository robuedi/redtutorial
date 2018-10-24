<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use App\Libraries\UIMessage;

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
        try {
            if (Sentinel::check() && (Sentinel::hasAccess('admin'))) {
                return $next($request);
            }
        } catch (NotActivatedException $e) {
            return redirect(config('app.admin_route'))->withErrors(['Account not activated.']);
        }

        return redirect(config('app.admin_route'))->withErrors(['You must be logged in as admin.']);
    }
}
