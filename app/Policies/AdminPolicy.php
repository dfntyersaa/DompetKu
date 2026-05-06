<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Check if user is admin
     */
    public function viewDashboard(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if user can manage users
     */
    public function manageUsers(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if user can update username
     */
    public function updateUsername(User $user, User $targetUser)
    {
        return $user->role === 'admin';
    }

    /**
     * Check if user can view user details
     */
    public function viewUserDetails(User $user)
    {
        return $user->role === 'admin';
    }
}
