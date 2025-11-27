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
        $this->authorize('create', Livro::class);

        $categorias = Categoria::all();
        $autores = Autor::all(); // <-- ADICIONAR

        if ($categorias->isEmpty() || $autores->isEmpty()) {
            return redirect()->route('livros.index')
                    ->with('error', 'Cadastre categorias e autores antes de cadastrar um livro!');
        }

        return view('livros.create', compact('categorias', 'autores'));
    }

    public function store(Request $request)
    {
            // Só o admin pode cadastrar
            if (auth()->user()->email !== 'teste@gmail.com') {
                return redirect('/')->with('error', 'Apenas o ADMIN pode cadastrar livros.');
            }

            // Código normal de salvar
            Livro::create($request->all());
            return redirect('/livros');

        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'autor' => 'required|string|max:255',
            'ano' => 'required|integer',
            'quantidade' => 'required|integer',
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();

        if ($request->hasFile('capa')) {
            $capa = $request->file('capa');
            $nomeCapa = time() . '.' . $capa->getClientOriginalExtension();
            $capa->move(public_path('capas'), $nomeCapa);
            $data['capa'] = $nomeCapa; // MUITO IMPORTANTE
        }

        Livro::create($data);

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
