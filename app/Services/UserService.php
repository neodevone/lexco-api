<?php
namespace App\Services;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    /**
     * Listar todos los usuarios.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() { return $this->userRepository->all(); }

    /**
     * Obtener usuario por ID.
     * @param int $id
     * @return User
     */
    public function find(int $id) { return $this->userRepository->find($id); }

    /**
     * Crear usuario.
     * @param array $data
     * @return User
     */
    public function create(array $data): User { return $this->userRepository->create($data); }

    /**
     * Actualizar usuario.
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User { return $this->userRepository->update($id, $data); }

    /**
     * Eliminar usuario.
     * @param int $id
     * @return bool
     */
    public function delete(int $id) { return $this->userRepository->delete($id); }
}