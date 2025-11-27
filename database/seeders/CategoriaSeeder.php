<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Didáticos', 'descricao' => 'Livros de estudo'],
            ['nome' => 'Romance', 'descricao' => 'Amor e drama'],
            ['nome' => 'Ficção', 'descricao' => 'Histórias inventadas'],
            ['nome' => 'Ciência', 'descricao' => 'Tecnologia e estudos']
        ]);
    }

}
