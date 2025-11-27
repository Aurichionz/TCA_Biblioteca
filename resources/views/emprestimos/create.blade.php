@extends('layouts.app')
<form action="{{ route('emprestimos.store') }}" method="POST">
    @csrf
    <label>Livro:</label>
    <select name="livro_id" required>
        @foreach($livros as $livro)
            <option value="{{ $livro->id }}">{{ $livro->titulo }} ({{ $livro->quantidade }} disponíveis)</option>
        @endforeach
    </select>

    <label>Aluno:</label>
    <select name="aluno_id" required>
        @foreach($alunos as $aluno)
            <option value="{{ $aluno->id }}">{{ $aluno->name }}</option>
        @endforeach
    </select>

    <label>Data do Empréstimo:</label>
    <input type="date" name="data_emprestimo" required>

    <button type="submit">Registrar Empréstimo</button>
</form>
