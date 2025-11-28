@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Lista de Categorias</h1>
    <a href="{{ route('categorias.create') }}"
       class="inline-block bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow mb-4">
       Nova Categoria
    </a>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-pink-200 rounded">
            <thead class="bg-pink-600 text-white font-semibold">
                <tr>
                    <th class="px-4 py-2 border border-pink-200 text-left">ID</th>
                    <th class="px-4 py-2 border border-pink-200 text-left">Nome</th>
                    <th class="px-4 py-2 border border-pink-200 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-white">
                        <td class="px-4 py-2 border border-pink-200">{{ $categoria->id }}</td>
                        <td class="px-4 py-2 border border-pink-200">{{ $categoria->nome }}</td>
                        <td class="px-4 py-2 border border-pink-200 flex gap-2">
                            <a href="{{ route('categorias.edit', $categoria->id) }}"
                               class="bg-pink-500 text-white px-3 py-1 rounded shadow text-sm">
                               Editar
                            </a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-pink-700 text-white px-3 py-1 rounded shadow text-sm"
                                        onclick="return confirm('Tem certeza?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
