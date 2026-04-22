<?php
namespace App\Services;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(private UserRepository $userRepository) {}

    /**
     * Registrar nuevo usuario, el primero es admin.
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $role = $this->userRepository->count() === 0 ? 'admin' : 'user';
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $role,
        ]);
    }

    /**
     * Autenticar usuario y retornar token.
     * @param array $credentials
     * @return User
     * @throws ValidationException
     */
    public function login(array $credentials): User
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales incorrectas.',
            ]);
        }
        return Auth::user();
    }

    /**
     * Cerrar sesión del usuario actual.
     * @param User $user
     * @return void
     */
    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}