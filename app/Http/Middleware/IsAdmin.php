<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.'
                ], 401);
            }
            return redirect('/login');
        }

        if ($request->user()->role !== 'admin') {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Admin access required.',
                    'error' => 'forbidden'
                ], 403);
            }
            abort(403, 'Admin access required.');
        }

        return $next($request);
    }
}
