<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function review(User $user, User $model): bool
    {
        return $user->userable_type !== $model->userable_type;
    }
}
