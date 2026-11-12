<?php

namespace App\Actions\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function execute(array $data) {
        $user = User::create([
            'fio' => $data['fio'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => '/avatar/default.png',
            'role' => 'client',
        ]);
        $token = $user->createToken('api_token')->plainTextToken;

        return $user->createToken('api_token')->plainTextToken;
    }



}
