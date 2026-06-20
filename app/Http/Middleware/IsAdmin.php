<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Only allow logged-in users with role = admin to pass through.
     * Anyone else is sent back to the homepage with an error message.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}
