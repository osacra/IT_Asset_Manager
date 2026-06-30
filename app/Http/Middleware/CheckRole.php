<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Trata a requisição de entrada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Se o usuário não estiver autenticado ou seu perfil não corresponder ao exigido
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Acesso não autorizado para o seu perfil de usuário.');
        }

        return $next($request);
    }
}