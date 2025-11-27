<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmprestimoController extends Controller
{
    // Listagem
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            // Admin vê todos os empréstimos
            $emprestimos = Emprestimo::with(['livro', 'aluno'])->get();
        } else {
            // Usuário vê apenas seus próprios empréstimos (ou visitante)
            $emprestimos = [];
            if(auth()->check()) {
                $emprestimos = Emprestimo::with('livro')
                    ->where('aluno_id', auth()->id())
                    ->get();
            }
        }

        return view('emprestimos.index', compact('emprestimos'));
    }


    public function create()
    {
        // Só o admin pode cadastrar livros
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Você não é ADMIN.');
        }

        // PEGAR CATEGORIAS E AUTORES DO BANCO
        $categorias = Categoria::all();
        $autores = Autor::all();

        return view('livros.create', compact('categorias', 'autores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
        ]);

        Emprestimo::create([
            'livro_id'        => $request->livro_id,
            'aluno_id'        => auth()->id(),
            'data_emprestimo' => Carbon::now(),
            'data_devolucao'  => Carbon::now()->addDays(7), // +7 DIAS AUTOMÁTICOS
            
        ]);

        return redirect()->route('emprestimos.index')
            ->with('success', 'Empréstimo realizado! Devolução em 7 dias.');
    }

    // Devolução (admin)
    public function devolucao(Emprestimo $emprestimo)
    {
        if ($emprestimo->status == 'Emprestado') {
            $emprestimo->status = 'Devolvido';
            $emprestimo->data_devolucao = Carbon::now();
            $emprestimo->save();

            $emprestimo->livro->quantidade += 1;
            $emprestimo->livro->save();
        }

        return redirect()->route('emprestimos.index')->with('success', 'Livro devolvido!');
    }

    // Apenas admin pode deletar
    public function destroy(Emprestimo $emprestimo)
    {
        if(auth()->check() && auth()->user()->is_admin) {
            $emprestimo->delete();
            return redirect()->route('emprestimos.index')->with('success', 'Empréstimo excluído!');
        }

        abort(403);
    }

    public function admin()
{
    $emprestimos = Emprestimo::with('livro', 'aluno')->get();
    return view('emprestimos.admin', compact('emprestimos'));
}

}
