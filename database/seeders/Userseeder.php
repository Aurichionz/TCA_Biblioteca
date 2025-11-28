<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'teste@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Usuário Comum',
            'email' => 'teste2@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => false,
        ]);
    }
}
