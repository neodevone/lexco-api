<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    /**
     * Listar todos los usuarios.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->userService->all());
    }

    /**
     * Obtener usuario por ID.
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->userService->find($id));
    }

    /**
     * Crear usuario.
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->validated());
        return response()->json($user, 201);
    }

    /**
     * Actualizar usuario.
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->update($id, $request->validated());
        return response()->json($user);
    }

    /**
     * Eliminar usuario.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(['message' => 'Usuario eliminado']);
    }
}