@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Editar Livro</h1>

    <form action="{{ route('livros.update', $livro->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="titulo" class="block text-sm font-medium text-pink-700 mb-1">Título</label>
            <input type="text" name="titulo" id="titulo"
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300"
                   value="{{ $livro->titulo }}" required>
        </div>
        <div>
            <label for="categoria_id" class="block text-sm font-medium text-pink-700 mb-1">Categoria</label>
            <select name="categoria_id" id="categoria_id"
                    class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300"
                    required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}"
                        {{ $livro->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit"
                class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
