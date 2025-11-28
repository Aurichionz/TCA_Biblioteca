@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Editar Autor</h1>
    @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded bg-red-100 border border-red-200 text-red-700">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('autores.update', $autor->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="nome" class="block text-sm font-medium text-pink-700 mb-1">Nome do Autor</label>
            <input type="text" name="nome" id="nome" value="{{ $autor->nome }}" required
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
        </div>
        <div class="flex gap-4 mt-4">
            <a href="{{ route('autores.index') }}"
               class="bg-pink-300 text-gray-700 font-semibold px-4 py-2 rounded shadow">
               Voltar
            </a>

            <button type="submit"
                    class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Atualizar Autor
            </button>
        </div>
    </form>
</div>
@endsection
