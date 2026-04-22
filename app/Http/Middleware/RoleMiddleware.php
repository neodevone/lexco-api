<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verificar que el usuario tenga el rol requerido.
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            return response()->json(['message' => 'Acceso no autorizado'], 403);
        }
        return $next($request);
    }
}