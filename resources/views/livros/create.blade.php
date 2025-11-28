@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Cadastrar Novo Livro</h1>
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-200 text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded bg-red-100 border border-red-200 text-red-700">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('livros.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label for="titulo" class="block text-sm font-medium text-pink-700 mb-1">Título</label>
            <input type="text" name="titulo" id="titulo" placeholder="Título do livro"
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300"
                   required>
        </div>
        <div>
            <label for="categoria_id" class="block text-sm font-medium text-pink-700 mb-1">Categoria</label>
            <select name="categoria_id" id="categoria_id" required
                    class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option value="">Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="autor" class="block text-sm font-medium text-pink-700 mb-1">Autor</label>
            <select name="autor" id="autor" required
                    class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option value="">Selecione um autor</option>
                @foreach($autores as $autor)
                    <option value="{{ $autor->nome }}"
                        {{ (isset($livro) && $livro->autor == $autor->nome) ? 'selected' : '' }}>
                        {{ $autor->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="ano" class="block text-sm font-medium text-pink-700 mb-1">Ano de publicação</label>
            <input type="number" name="ano" id="ano" placeholder="Ano"
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300"
                   required>
        </div>
        <div>
            <label for="quantidade" class="block text-sm font-medium text-pink-700 mb-1">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade em estoque"
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300"
                   required>
        </div>
        <div>
            <label for="capa" class="block text-sm font-medium text-pink-700 mb-1">Capa do livro</label>
            <input type="file" name="capa" id="capa" accept="image/*"
                   class="w-full text-gray-700 border border-pink-200 rounded px-3 py-2">
        </div>
        <div class="flex gap-4 mt-4">
            <a href="{{ route('livros.index') }}"
               class="bg-pink-300 text-gray-700 font-semibold px-4 py-2 rounded shadow">
               Voltar
            </a>

            <button type="submit"
                    class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Cadastrar Livro
            </button>
        </div>
    </form>
</div>
@endsection
