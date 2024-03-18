<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\RoleType;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            $roleEnum = RoleType::from($role);
            // Check if the authenticated user's role matches any of the required roles
            if ($request->user() && $request->user()->role == $roleEnum) {
                return $next($request);
            }
        }

        abort(403);
    }
}
