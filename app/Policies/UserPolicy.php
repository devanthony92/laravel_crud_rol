<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir que el admin haga todo.
     */
    public function before(User $authUser, $ability)
    {
        if ($authUser->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Ver si puede ver la lista de usuarios.
     */
    public function viewAny(User $authUser)
    {
        return $authUser->hasAnyRole(['admin']);
    }

    /**
     * Ver si puede ver un usuario específico.
     */
    public function view(User $authUser, User $user)
    {
        // Puede ver su propio perfil o cualquier otro si es admin (ya cubierto por before)
        return $authUser->id === $user->id;
    }

    /**
     * Ver si puede crear usuarios.
     */
    public function create(User $authUser)
    {
        return $authUser->hasRole('admin');
    }

    /**
     * Ver si puede actualizar un usuario.
     */
    public function update(User $authUser, User $user)
    {
        // Puede editarse a sí mismo o si es admin (ya cubierto por before)
        return $authUser->id === $user->id;
    }

    /**
     * Ver si puede eliminar un usuario.
     */
    public function delete(User $authUser, User $user)
    {
        // No puede eliminarse a sí mismo, solo otros usuarios
        return $authUser->id !== $user->id;
    }

}
