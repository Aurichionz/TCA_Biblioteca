@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Controle de Empréstimos</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Livro</th>
                <th>Aluno</th>
                <th>Data Empréstimo</th>
                <th>Data Devolução</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emprestimos as $emprestimo)
                <tr>
                    <td>{{ $emprestimo->livro->titulo ?? 'Livro removido' }}</td>
                    <td>{{ $emprestimo->aluno->name ?? 'Usuário removido' }}</td>
                    <td>{{ $emprestimo->data_emprestimo }}</td>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_devolucao)}}</td>
                    <td>{{ $emprestimo->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
