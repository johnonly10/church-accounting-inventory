<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleTypeMiddleware
{
    public function handle(Request $request, Closure $next, ...$types)
    {
        $user = $request->user();

        if (!$user) abort(403);

        if (!in_array($user->roletype, $types, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
