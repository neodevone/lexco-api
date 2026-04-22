<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class MaxAuthenticatedUsers
{
    private const MAX_USERS = 2;

    /**
     * Limitar máximo 2 usuarios autenticados simultáneamente.
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $activeTokens = PersonalAccessToken::whereNotNull('last_used_at')
            ->where('last_used_at', '>=', now()->subMinutes(30))
            ->distinct('tokenable_id')
            ->count('tokenable_id');

        if ($activeTokens >= self::MAX_USERS) {
            return response()->json([
                'message' => 'Límite de usuarios autenticados alcanzado (máximo 2)',
            ], 429);
        }

        return $next($request);
    }
}