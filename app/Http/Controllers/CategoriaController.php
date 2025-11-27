<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function __construct()
{
    if (!auth()->user()->is_admin) {
        abort(403, 'Acesso negado.');
    }
}

    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $categorias = Categoria::all(); // pega todas do banco
        return view('categorias.index', compact('categorias'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validação simples
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string'
        ]);

        // salvar no banco
        Categoria::create($request->all());

        // REDIRECIONAR PARA A LISTA DE CATEGORIAS
        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string'
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Excluído com sucesso!');
    }

}
