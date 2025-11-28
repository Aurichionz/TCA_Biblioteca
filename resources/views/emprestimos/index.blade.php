@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-semibold text-pink-700 mb-6">Controle de Empréstimos</h1>

                <!-- Tabela -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-pink-200 rounded">
                        <thead class="bg-pink-600 text-white font-semibold">
                            <tr>
                                <th class="px-4 py-2 border border-pink-200 text-left">ID</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Livro</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Aluno</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Data Empréstimo</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Data Devolução</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Status</th>
                                <th class="px-4 py-2 border border-pink-200 text-left">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($emprestimos as $e)
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->id }}</td>
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->livro->titulo }}</td>
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->aluno->name ?? 'Visitante' }}</td>
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->data_emprestimo }}</td>
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->data_devolucao ?? '-' }}</td>
                                    <td class="px-4 py-2 border border-pink-200">{{ $e->status }}</td>
                                    <td class="px-4 py-2 border border-pink-200">
                                        <div class="flex flex-col items-center space-y-2">
                                            {{-- Botão de Comprovante de Empréstimo (PDF) --}}
                                            <a href="{{ route('emprestimos.comprovante', $e->id) }}" 
                                               class="bg-pink-500 text-white text-xs py-1 px-3 rounded hover:bg-pink-700 w-24 text-center"
                                               target="_blank">
                                                Comprovante
                                            </a>

                                            {{-- Botão de Histórico / Declaração (PDF) --}}
                                            @if($e->aluno)
                                                <a href="{{ route('alunos.historico', $e->aluno->id) }}" 
                                                   class="bg-pink-700 text-white text-xs py-1 px-3 rounded hover:bg-pink-700 w-24 text-center"
                                                   target="_blank">
                                                    Histórico
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
