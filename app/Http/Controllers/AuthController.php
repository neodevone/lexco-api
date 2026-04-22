<?php
namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    /**
     * Registrar nuevo usuario.
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Usuario registrado exitosamente',
        ], 201)->withCookie(
            cookie('auth_token', $token, 60 * 24, '/', null, true, true)
        );
    }

    /**
     * Iniciar sesión.
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->login($request->only('email', 'password'));
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Sesión iniciada exitosamente',
        ])->withCookie(
            cookie('auth_token', $token, 60 * 24, '/', null, true, true)
        );
    }

    /**
     * Cerrar sesión.
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json([
            'message' => 'Sesión cerrada exitosamente',
        ])->withCookie(cookie()->forget('auth_token'));
    }

    /**
     * Obtener usuario autenticado.
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}