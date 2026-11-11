<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginUserAction
{
    public function execute(array $data): string {
        $user = User::where('email', $data['email'])->first();

        if (!$user || Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedHttpException('login');
        }

        return $user->createToken('api_token')->plainTextToken;

    }
}
