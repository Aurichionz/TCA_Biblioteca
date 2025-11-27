@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Autores Cadastrados</h1>

    <a href="{{ route('autores.create') }}" class="btn btn-primary mb-3">Novo Autor</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
