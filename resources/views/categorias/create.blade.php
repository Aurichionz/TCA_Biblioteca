@extends('layouts.app')

@section('content')
<form action="{{ route('categorias.store') }}" method="POST" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-4">
    @csrf
    <div>
        <label for="nome" class="block text-sm font-medium text-pink-700 mb-1">Nome da Categoria</label>
        <input type="text" name="nome" id="nome" placeholder="Nome da categoria" required
               class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
    </div>
    <div class="flex gap-4 mt-4">
        <a href="{{ route('categorias.index') }}"
           class="bg-pink-300 text-gray-700 font-semibold px-4 py-2 rounded shadow">
           Voltar
        </a>

        <button type="submit"
                class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
            Salvar
        </button>
    </div>
</form>
@endsection
