<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\RoleType;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $roleEnum = RoleType::from($role);
        // Check if the authenticated user's role matches the required role
        if ($request->user() && $request->user()->role != $roleEnum) {
            abort(403);
        }
        return $next($request);
    }
}
