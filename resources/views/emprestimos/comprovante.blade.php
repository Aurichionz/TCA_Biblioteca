<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border border-pink-200">
    <h2 class="text-2xl font-semibold text-pink-700 mb-4 text-center">Comprovante de Empréstimo</h2>

    <div class="space-y-2 text-gray-800">
        <p><span class="font-semibold">ID:</span> {{ $emprestimo->id }}</p>
        <p><span class="font-semibold">Aluno:</span> {{ $emprestimo->aluno->name }}</p>
        <p><span class="font-semibold">Livro:</span> {{ $emprestimo->livro->titulo }}</p>
        <p><span class="font-semibold">Data de Empréstimo:</span> {{ $emprestimo->data_emprestimo->format('d/m/Y') }}</p>
        <p><span class="font-semibold">Data de Devolução:</span> 
            {{ $emprestimo->data_devolucao ? $emprestimo->data_devolucao->format('d/m/Y') : '-' }}
        </p>
        <p><span class="font-semibold">Status:</span> {{ $emprestimo->status }}</p>
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-500">Comprovante gerado pelo sistema da Biblioteca</p>
    </div>
</div>
