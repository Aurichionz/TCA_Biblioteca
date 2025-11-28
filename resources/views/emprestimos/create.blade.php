@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <h1 class="text-2xl font-semibold text-pink-700 mb-6">Registrar Empréstimo</h1>

    <form action="{{ route('emprestimos.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="livro_id" class="block text-sm font-medium text-pink-700 mb-1">Livro:</label>
            <select name="livro_id" id="livro_id" required
                    class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @foreach($livros as $livro)
                    <option value="{{ $livro->id }}">
                        {{ $livro->titulo }} ({{ $livro->quantidade }} disponíveis)
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="aluno_id" class="block text-sm font-medium text-pink-700 mb-1">Aluno:</label>
            <select name="aluno_id" id="aluno_id" required
                    class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="data_emprestimo" class="block text-sm font-medium text-pink-700 mb-1">Data do Empréstimo:</label>
            <input type="date" name="data_emprestimo" id="data_emprestimo" required
                   class="w-full border border-pink-200 rounded px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
        </div>
        <div class="mt-4">
            <button type="submit"
                    class="bg-pink-600 text-white font-semibold px-4 py-2 rounded shadow">
                Registrar Empréstimo
            </button>
        </div>
    </form>
</div>
@endsection
