<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@flight.ru'],
            [
                'fio' => 'Администратор Системы',
                'password' => Hash::make('QWEasd123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@flight.ru'],
            [
                'fio' => 'Иванов Иван Иванович',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );
    }
}
