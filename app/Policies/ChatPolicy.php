<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChatPolicy
{
    public function view(User $user, Chat $chat): bool
    {
        return $user->in_chat($chat);
    }

    public function message(User $user, Chat $chat): bool
    {
        return $user->in_chat($chat);
    }

    public function archive(User $user, Chat $chat): bool
    {
        return $user->in_chat($chat);
    }
}
