<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if(!$request->user() || !$request->user()->hasRoles($role)){
                abort(404);
            }
        }

        return $next($request);
    }
}
