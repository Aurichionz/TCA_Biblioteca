@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Livros Cadastrados</h1>

    {{-- MENSAGEM DE SUCESSO --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- BOTÃO SOMENTE PARA ADMIN --}}
    @if(Auth::check() && Auth::user()->is_admin)
        <a href="{{ route('livros.create') }}" class="btn btn-success mb-3">
            ➕ Cadastrar Novo Livro
        </a>
    @endif

    {{-- TABELA DE LIVROS --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Capa</th>
                <th>Título</th>
                <th>Categoria</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Qtd</th>
                <th>Ações / Empréstimo</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>

                    {{-- CAPA --}}
                    <td>
                        @if($livro->capa)
                            <img src="{{ asset('capas/' . $livro->capa) }}" alt="Capa" width="50" class="rounded shadow-sm">
                        @else
                            <span class="text-muted">Sem capa</span>
                        @endif
                    </td>

                    {{-- DADOS --}}
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->categoria->nome }}</td>
                    <td>{{ $livro->autor }}</td>
                    <td>{{ $livro->ano }}</td>
                    <td>{{ $livro->quantidade }}</td>

                    {{-- AÇÕES --}}
                    <td>
                        {{-- SE FOR ADMIN --}}
                        @if(Auth::check() && Auth::user()->is_admin)

                            <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-warning btn-sm">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esse livro?')">
                                    🗑️ Excluir
                                </button>
                            </form>

                        {{-- SE FOR USUÁRIO NORMAL --}}
                        @else
                            @if($livro->quantidade > 0)
                                <form action="{{ route('emprestimos.store') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="livro_id" value="{{ $livro->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        📚 Pegar emprestado
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-danger">Indisponível</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
