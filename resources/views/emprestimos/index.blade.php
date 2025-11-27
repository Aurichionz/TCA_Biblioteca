@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Livro</th>
                            <th>Aluno</th>
                            <th>Data Empréstimo</th>
                            <th>Data Devolução</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($emprestimos as $e)
                        <tr>
                            <td>{{ $e->id }}</td>
                            <td>{{ $e->livro->titulo }}</td>
                            <td>{{ $emprestimo->aluno->name ?? 'Visitante' }}</td>
                            <td>{{ $e->data_emprestimo }}</td>
                            <td>{{ $e->data_devolucao ?? '-' }}</td>
                            <td>{{ $e->status }}</td>
                            <td>
                                {{-- Botão de devolução para admin --}}
                                @if(auth()->check() && auth()->user()->is_admin && $e->status == 'Emprestado')
                                    <form action="{{ route('emprestimos.devolucao', $e->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm">Devolver</button>
                                    </form>
                                @endif

                                {{-- Botão de exclusão apenas para admin --}}
                                @if(auth()->check() && auth()->user()->is_admin)
                                    <form action="{{ route('emprestimos.destroy', $e->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
