<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;


class EmprestimoController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            $emprestimos = Emprestimo::with(['livro', 'aluno'])->get();
        } else {
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
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Você não é ADMIN.');
        }
        $categorias = Categoria::all();
        $autores = Autor::all();

        return view('livros.create', compact('categorias', 'autores'));
    }

   public function store(Request $request)
{
    $request->validate([
        'livro_id' => 'required|exists:livros,id',
    ]);

    $livro = Livro::find($request->livro_id);

    if (!$livro) {
        return redirect()->back()->with('error', 'Livro não encontrado.');
    }

    if ($livro->quantidade < 1) {
        return redirect()->back()->with('error', 'Livro indisponível.');
    }

    Emprestimo::create([
        'livro_id'        => $livro->id,
        'aluno_id'        => auth()->id(),
        'data_emprestimo' => Carbon::now(),
        'data_devolucao'  => Carbon::now()->addDays(7),
        'status'          => 'emprestado',
    ]);

    $livro->quantidade -= 1;
    $livro->save();

    return redirect()->route('emprestimos.index')
        ->with('success', 'Empréstimo realizado! Devolução em 7 dias.');
}


    public function admin()
    {
        $emprestimos = Emprestimo::with('livro', 'aluno')->get();
        return view('emprestimos.admin', compact('emprestimos'));
    }

    public function comprovantePDF($id)
    {
        $emprestimo = Emprestimo::with('livro', 'aluno')->findOrFail($id);

        $pdf = PDF::loadView('emprestimos.comprovante', compact('emprestimo'));
        return $pdf->download('comprovante_emprestimo_'.$id.'.pdf');
    }

    public function historicoPDF($aluno_id)
    {
        $emprestimos = Emprestimo::with('livro')
            ->where('aluno_id', $aluno_id)
            ->get();

        $pdf = PDF::loadView('emprestimos.historico', compact('emprestimos'));
        return $pdf->download('historico_emprestimos_aluno_'.$aluno_id.'.pdf');
    }
}
