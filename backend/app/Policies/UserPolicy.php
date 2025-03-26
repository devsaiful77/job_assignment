<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine if the user can manage all users.
     */
    public function manageUsers(User $user)
    {
        return $user->role_id == 1;
    }

    /**
     * Determine if the user can update another user.
     */
    public function update(User $user, User $targetUser)
    {
        return $user->role_id == 1 || $user->id === $targetUser->id;
    }

    /**
     * Determine if the user can delete another user.
     */
    public function delete(User $user, User $targetUser)
    {
        return $user->role_id == 1;
    }
}
