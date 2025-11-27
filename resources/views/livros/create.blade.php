@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Livro</h1>

    <a href="{{ route('livros.index') }}" class="btn btn-secondary mb-3">Voltar</a>

    {{-- Exibir mensagens de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Exibir erros de validação --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


        <div class="form-group mt-2">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" placeholder="Título do livro" required>
        </div>

        <div class="form-group mt-2">
            <label for="categoria_id">Categoria</label>
            <select name="categoria_id" class="form-control" required>
                <option value="">Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
       <label for="autor_id">Autor</label>
            <select name="autor_id" class="form-control" required>
                <option value="">Selecione um autor</option>
            @foreach($autores as $autor)
                <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
            @endforeach
        </select>
    </div>


        <div class="form-group mt-2">
            <label for="ano">Ano de publicação</label>
            <input type="number" name="ano" class="form-control" placeholder="Ano" required>
        </div>

        <div class="form-group mt-2">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" placeholder="Quantidade em estoque" required>
        </div>

        <div class="form-group mt-2">
            <label for="capa">Capa do livro</label>
            <input type="file" name="capa" accept="image/*" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-3">Cadastrar Livro</button>
    </form>
</div>
@endsection
