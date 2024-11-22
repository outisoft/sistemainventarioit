<?php

namespace App\Policies;

use App\Models\User;

class RecordPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Record $record)
    {
        return $user->hasRole('Administrator') || $user->country === $record->country;
    }

    public function update(User $user, Record $record)
    {
        return $user->hasRole('Administrator') || $user->country === $record->country;
    }

    public function delete(User $user, Record $record)
    {
        return $user->hasRole('Administrator') || $user->country === $record->country;
    }
}
