<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica se o usuário está autenticado
        if (!$request->user()) {
            // Se for API, retorna JSON 401
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                    'error' => 'authentication_required'
                ], 401);
            }

            // Se for web, redireciona para login
            return redirect('/login');
        }

        // Se for Admin, tem acesso total (Superuser)
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        // Verifica se a role do utilizador corresponde à exigida
        if ($request->user()->role !== $role) {
            // Se for API, retorna JSON 403
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'message' => 'ACESSO NÃO AUTORIZADO: Não tem permissão para aceder a esta área.',
                    'error' => 'forbidden',
                    'required_role' => $role,
                    'user_role' => $request->user()->role
                ], 403);
            }

            // Se for web, aborta com 403
            abort(403, 'ACESSO NÃO AUTORIZADO: Não tem permissão para aceder a esta área.');
        }

        return $next($request);
    }
}
