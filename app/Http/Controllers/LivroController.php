<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\AutorController;
use App\Models\Autor;


class LivroController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $livros = Livro::with('categoria')->get();
        return view('livros.index', compact('livros'));
    }

    public function create()
{
    $this->authorize('create', Livro::class); // CORRETO! Está no Controller

    $categorias = Categoria::all();
    $autores = Autor::all();

    return view('livros.create', compact('categorias', 'autores'));
}

    public function store(Request $request)
{
    // Só o ADMIN pode cadastrar
    if (auth()->user()->email !== 'teste@gmail.com') {
        return redirect('/')->with('error', 'Apenas o ADMIN pode cadastrar livros.');
    }

    // 📌 VALIDAR ANTES DE SALVAR!
    $request->validate([
    'titulo' => 'required|string',
    'categoria_id' => 'required|exists:categorias,id',
    'autor_id' => 'required|exists:autores,id', // corrigido
    'ano' => 'required|integer',
    'quantidade' => 'required|integer',
    'capa' => 'nullable|image',
]);


    $data = $request->all();

    // 📌 UPLOAD DA CAPA
    if ($request->hasFile('capa')) {
        $capa = $request->file('capa');
        $nomeCapa = time() . '.' . $capa->getClientOriginalExtension();
        $capa->move(public_path('capas'), $nomeCapa);
        $data['capa'] = $nomeCapa;
    }

    // 📌 SALVAR NO BANCO
    Livro::create($data);

    // 📌 REDIRECIONAR PARA A LISTA
    return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
}


    public function edit($id)
    {
        $livro = Livro::findOrFail($id);
        $categorias = Categoria::all();
        return view('livros.edit', compact('livro', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'categoria_id' => 'required',
        ]);

        $livro = Livro::findOrFail($id);
        $livro->update($request->all());

        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído!');
    }

    public function show(Livro $livro)
    {
        return view('livros.show', compact('livro'));
    }

}
