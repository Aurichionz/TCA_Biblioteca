<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

    function run(): void
{
    // ADMIN
    User::firstOrCreate(
        ['email' => 'teste@gmail.com'],
        [
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'role' => 'admin'    // <---- AQUI DEFINIMOS O PAPEL
        ]
    );

    // USUÁRIO NORMAL
    User::firstOrCreate(
        ['email' => 'teste2@gmail.com'],
        [
            'name' => 'Usuário',
            'password' => Hash::make('123456'),
            'role' => 'user'     // <---- USUÁRIO NORMAL
        ]
    );
}

