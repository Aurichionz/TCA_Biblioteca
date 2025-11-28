@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Controle de Empréstimos</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-pink-200 rounded shadow-sm">
            <thead class="bg-pink-600 border-b border-pink-200">
                <tr>
                    <th class="px-4 py-2 text-left text-white font-medium">Livro</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Aluno</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Data Empréstimo</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Data Devolução</th>
                    <th class="px-4 py-2 text-left text-white font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-200">
                @foreach($emprestimos as $emprestimo)
                    <tr class="bg-white">
                        <td class="px-4 py-2 text-gray-700">{{ $emprestimo->livro->titulo ?? 'Livro removido' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $emprestimo->aluno->name ?? 'Usuário removido' }}</td>
                        <td class="px-4 py-2 text-gray-700">{{ $emprestimo->data_emprestimo }}</td>
                        <td class="px-4 py-2 text-gray-700">
                            {{ $emprestimo->data_devolucao ? \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-4 py-2 text-gray-700">{{ $emprestimo->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
