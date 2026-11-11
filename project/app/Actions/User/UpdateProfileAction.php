<?php

namespace App\Actions\User;
use App\Models\User;


class UpdateProfileAction
{
    public function execute(User $user, array $data): User
    {
        $user->update(array_filter($data, fn ($value) => !is_null($value)));
        return $user->fresh();
    }
}
