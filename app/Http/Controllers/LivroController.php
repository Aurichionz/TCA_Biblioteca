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
       $livros = Livro::with(['categoria','autor'])->get();
        return view('livros.index', compact('livros'));
    }

        public function create()
    {
        $this->authorize('create', Livro::class);

        $categorias = Categoria::all();
        $autores = Autor::all();

        return view('livros.create', compact('categorias', 'autores'));
    }

    public function store(Request $request)
    {
    if (auth()->user()->email !== 'teste@gmail.com') {
        return redirect('/')->with('error', 'Apenas o ADMIN pode cadastrar livros.');
    }

    $request->validate([
        'titulo' => 'required|string',
        'categoria_id' => 'required|exists:categorias,id',
        'autor' => 'required|string',
        'ano' => 'required|integer',
        'quantidade' => 'required|integer',
        'capa' => 'nullable|image',
    ]);

    $data = $request->all();

    if ($request->hasFile('capa')) {
        $capa = $request->file('capa');
        $nomeCapa = time() . '.' . $capa->getClientOriginalExtension();
        $capa->move(public_path('capas'), $nomeCapa);
        $data['capa'] = $nomeCapa;
    }

    Livro::create([
        'titulo' => $data['titulo'],
        'categoria_id' => $data['categoria_id'],
        'autor' => $data['autor'],
        'ano' => $data['ano'],
        'quantidade' => $data['quantidade'],
        'capa' => $data['capa'] ?? null,
    ]);

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
