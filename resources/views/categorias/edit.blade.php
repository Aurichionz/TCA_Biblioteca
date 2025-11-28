@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Editar Categoria</h1>
    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nome" class="block text-sm font-medium text-pink-700 mb-1">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ $categoria->nome }}" required
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
        </div>
        <div class="flex gap-4 mt-4">
            <a href="{{ route('categorias.index') }}"
               class="bg-pink-300 text-gray-700 font-semibold px-4 py-2 rounded shadow">
               Voltar
            </a>

            <button type="submit"
                    class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Atualizar
            </button>
        </div>
    </form>
</div>
@endsection
