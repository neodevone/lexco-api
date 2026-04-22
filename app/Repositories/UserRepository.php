<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    /**
     * Obtener todos los usuarios.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all() { return User::all(); }

    /**
     * Buscar usuario por ID.
     * @param int $id
     * @return User
     */
    public function find(int $id) { return User::findOrFail($id); }

    /**
     * Crear usuario.
     * @param array $data
     * @return User
     */
    public function create(array $data) { return User::create($data); }

    /**
     * Actualizar usuario.
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    /**
     * Eliminar usuario.
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return User::findOrFail($id)->delete();
    }

    /**
     * Contar total de usuarios.
     * @return int
     */
    public function count() { return User::count(); }
}