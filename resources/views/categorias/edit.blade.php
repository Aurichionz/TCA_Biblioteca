@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoria</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="nome" class="form-control" value="{{ $categoria->nome }}" required>
        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
    </form>
</div>
@endsection
