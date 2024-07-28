<?php

namespace App\Policies;

use App\Models\Seeker;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SeekerPolicy
{
    public function save(User $user): bool
    {
        return $user->is_saloon();
    }
}
