<?php

namespace App\Policies;

use App\Models\RoomType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RoomTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver tipos de habitacion');     
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RoomType $roomtype): bool
    {
        return $user->can('ver tipos de habitacion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('crear tipos de habitacion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RoomType $roomtype): bool
    {
        return $user->can('editar tipos de habitacion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RoomType $roomtype): bool
    {
        return $user->can('eliminar tipos de habitacion');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RoomType $roomtype): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RoomType $roomtype): bool
    {
        return false;
    }
}
