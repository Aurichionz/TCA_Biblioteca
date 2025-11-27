@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Autor</h1>

    <a href="{{ route('autores.index') }}" class="btn btn-secondary mb-3">Voltar</a>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autores.store') }}" method="POST">
        @csrf
        <div class="form-group mt-2">
            <label for="nome">Nome do Autor</label>
            <input type="text" name="nome" class="form-control" placeholder="Nome do autor" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Cadastrar Autor</button>
    </form>
</div>
@endsection
