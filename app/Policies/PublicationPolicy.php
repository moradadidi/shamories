<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Publication;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\GenericUser;

class PublicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Example: Allow any authenticated user to view all publications
        return true; // Or apply specific logic based on user roles or permissions
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Publication $publication): bool
    {
        // Example: Allow if the user is the owner of the publication or has special permissions
        return $user->id === $publication->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Example: Allow any authenticated user to create publications
        return true; // Or restrict this to certain roles
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(GenericUser $user, Publication $publication): bool
    {
        // Example: Allow update if the user is the owner of the publication
        return $user->id === $publication->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Publication $publication): bool
    {
        // Example: Allow delete if the user is the owner of the publication
        return $user->id === $publication->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Publication $publication): bool
    {
        // Example: Allow restore if the user is the owner of the publication
        return $user->id === $publication->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Publication $publication): bool
    {
        // Example: Allow force delete if the user is the owner of the publication
        return $user->id === $publication->user_id;
    }

    public function before(User $user, string $ability): bool
    {
        // Example: Only allow admins to perform certain actions
        return $user->role === 'admin';
    }
}
