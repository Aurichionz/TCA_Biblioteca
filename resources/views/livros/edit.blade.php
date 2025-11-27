@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Livro</h1>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="titulo" class="form-control"
               value="{{ $livro->titulo }}" required>

        <select name="categoria_id" class="form-control mt-2" required>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" 
                    {{ $livro->categoria_id == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-3">Atualizar</button>
    </form>
</div>
@endsection
