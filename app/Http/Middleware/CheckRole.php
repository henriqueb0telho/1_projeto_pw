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
        if (! $request->user()) {
            return redirect('/login');
        }

        // Se for Admin, tem acesso a tudo (Superuser)
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        // Verifica se a role do utilizador corresponde à role exigida pela rota
        if ($request->user()->role !== $role) {
            abort(403, 'ACESSO NÃO AUTORIZADO: Não tem permissão para aceder a esta área.');
        }

        return $next($request);
    }
}
