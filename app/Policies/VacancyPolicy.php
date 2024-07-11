<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\Response;

class VacancyPolicy
{
    public function create(User $user): bool
    {
        return $user->is_saloon();
    }

    public function update(User $user, Vacancy $vacancy): bool
    {
        return $user->userable()->is($vacancy->saloon);
    }

    public function delete(User $user, Vacancy $vacancy): bool
    {
        return $user->userable()->is($vacancy->saloon);
    }
}
