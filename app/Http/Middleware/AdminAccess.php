<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check() || ! Auth::user()->hasAnyRole([
            'super_admin', 'admin', 'editor', 'moderator', 'data_operator', 'analyst',
        ])) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
