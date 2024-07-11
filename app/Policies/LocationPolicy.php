<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LocationPolicy
{
    public function create(User $user): bool
    {
        return $user->is_saloon();
    }

    public function update(User $user, Location $location): bool
    {
        return $user->userable()->is($location->saloon);
    }

    public function delete(User $user, Location $location): bool
    {
        return $user->userable()->is($location->saloon);
    }
}
