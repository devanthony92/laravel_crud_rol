<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Permitir que los administradores hagan todo.
     */
    public function before(User $authUser, $ability)
    {
        if ($authUser->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Ver si puede ver la lista de productos.
     */
    public function viewAny(User $authUser)
    {
        return $authUser->hasAnyRole(['admin', 'seller', 'viewer']);
    }

    /**
     * Ver si puede ver un producto específico.
     */
    public function view(User $authUser, Product $product)
    {
        return $authUser->hasAnyRole(['admin', 'seller', 'viewer']);
    }

    /**
     * Ver si puede crear productos.
     */
    public function create(User $authUser)
    {
        return $authUser->hasAnyRole(['admin', 'seller']);
    }

    /**
     * Ver si puede actualizar productos.
     */
    public function update(User $authUser, Product $product)
    {
        return $authUser->hasAnyRole(['admin', 'seller']);
    }

    /**
     * Ver si puede eliminar productos.
     */
    public function delete(User $authUser, Product $product)
    {
        return $authUser->hasRole('admin');
    }

    /**
     * Ver si puede restaurar productos (si usas soft deletes).
     */
    public function restore(User $authUser, Product $product)
    {
        return $authUser->hasRole('admin');
    }

    /**
     * Ver si puede eliminar permanentemente productos.
     */
    public function forceDelete(User $authUser, Product $product)
    {
        return $authUser->hasRole('admin');
    }
}
