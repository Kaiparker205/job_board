<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Emploi; // Ensure you import the Emploi model

class EmploiPolicy
{
    /**
     * Determine whether the user can edit the resource.
     */
    public function edit(User $user, Emploi $emploi)
    {
        // Allow editing if the user has role_id 2
        return $user->role_id == 2  && ($emploi->employeur_id==$user->employeur->id);
    }

    /**
     * Determine whether the user can delete the resource.
     */
    public function delete(User $user, Emploi $emploi)
    {
        // Allow deletion if the user has role_id 2 and an associated employeur
        return $user->role_id == 2 && ($emploi->employeur_id==$user->employeur->id);
    }

    /**
     * Determine whether the user can update the resource.
     */
    public function update(User $user, Emploi $emploi)
    {
        // Allow updating if the user has role_id 2 and an associated employeur
        return $user->role_id == 2 && ($emploi->employeur_id==$user->employeur->id);
    }

    /**
     * Determine whether the user can create a new resource.
     */
    public function create(User $user)
    {
        // Allow creation if the user has role_id 2 and an associated employeur
        return $user->role_id == 2 && $user->employeur;
    }
}
