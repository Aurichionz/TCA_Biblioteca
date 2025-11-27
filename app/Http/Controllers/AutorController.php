<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
     public function index() {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    public function create() {
        return view('autores.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Autor::create($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id); // garante que temos o autor
        return view('autores.edit', compact('autor')); // deve passar o autor para a view
    }


    public function update(Request $request, Autor $autore)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $autore->update($request->all());

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Autor $autor) {
        $autor->delete();
        return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso!');
    }
}
