@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Livros Cadastrados</h1>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-200 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('livros.create') }}"
           class="mb-4 inline-block bg-pink-600 text-white font-semibold py-2 px-4 rounded shadow">
            Cadastrar Novo Livro
        </a>
    @endif

    <!-- Tabela de livros -->
    <div class="overflow-x-auto rounded-lg border border-pink-200 shadow-sm">
        <table class="min-w-full divide-y divide-pink-200">
            <thead class="bg-pink-600">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Capa</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Título</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Categoria</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Autor</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Ano</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Qtd</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-white">Ações / Empréstimo</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-pink-200">
                @foreach ($livros as $livro)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->id }}</td>

                        <td class="px-4 py-2">
                            @if($livro->capa)
                                <img src="{{ asset('capas/' . $livro->capa) }}"
                                    alt="Capa do livro"
                                    class="w-12 h-16 object-cover rounded shadow-sm">
                            @else
                                <span class="text-gray-400 text-sm">Sem capa</span>
                             @endif
                        </td>
                        </td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->titulo }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->categoria->nome }}</td>
                       <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->autor }}</>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->ano }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $livro->quantidade }}</td>

                        <td class="px-4 py-2 space-x-2">
                            @if(Auth::check() && Auth::user()->is_admin)
                                <a href="{{ route('livros.edit', $livro->id) }}"
                                   class="bg-pink-500 text-white text-xs font-semibold py-1 px-2 rounded shadow">
                                   Editar
                                </a>

                                <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-pink-700 text-white text-xs font-semibold py-1 px-2 rounded shadow"
                                        onclick="return confirm('Deseja excluir esse livro?')">
                                        Excluir
                                    </button>
                                </form>
                            @else
                                @if($livro->quantidade > 0)
                                    <form action="{{ route('emprestimos.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="livro_id" value="{{ $livro->id }}">
                                        <input type="hidden" name="aluno_id" value="{{ auth()->user()->id }}">
                                        <button type="submit"
                                            class="bg-pink-600 text-white text-xs font-semibold py-1 px-2 rounded shadow">
                                            Pegar emprestado
                                        </button>
                                    </form>
                                @else
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold py-1 px-2 rounded">Indisponível</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
