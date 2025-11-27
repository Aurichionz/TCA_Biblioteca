<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'categoria_id',
        'autor',
        'ano',
        'quantidade'
    ];

    // RELAÇÃO: um livro pertence a UMA categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }


}
