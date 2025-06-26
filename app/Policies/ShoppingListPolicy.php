<?php

namespace App\Policies;

use App\Models\ShoppingLists;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShoppingListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ShoppingLists $shoppingLists): bool
    {
        return $user->id === $shoppingLists->user_id ||
        $shoppingLists->collaborators()->where('users.id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ShoppingLists $shoppingLists): bool
    {
        // user can update if they are the owner or a collaborator
        return $user->id === $shoppingLists->user_id ||
        $shoppingLists->collaborators()->where('users.id', $user->id)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ShoppingLists $shoppingLists): bool
    {
        return $user->id === $shoppingLists->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ShoppingLists $shoppingLists): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ShoppingLists $shoppingLists): bool
    {
        return false;
    }
}
