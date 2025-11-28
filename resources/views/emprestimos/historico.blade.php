<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6 border border-pink-200">
    <h2 class="text-2xl font-semibold text-pink-700 mb-4 text-center">Histórico de Empréstimos</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-pink-200 rounded text-left">
            <thead class="bg-pink-600 text-white font-semibold">
                <tr>
                    <th class="px-4 py-2 border border-pink-200">ID</th>
                    <th class="px-4 py-2 border border-pink-200">Livro</th>
                    <th class="px-4 py-2 border border-pink-200">Data Empréstimo</th>
                    <th class="px-4 py-2 border border-pink-200">Data Devolução</th>
                    <th class="px-4 py-2 border border-pink-200">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($emprestimos as $e)
                    <tr class="bg-white hover:bg-pink-50">
                        <td class="px-4 py-2 border border-pink-200">{{ $e->id }}</td>
                        <td class="px-4 py-2 border border-pink-200">{{ $e->livro->titulo }}</td>
                        <td class="px-4 py-2 border border-pink-200">{{ $e->data_emprestimo->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 border border-pink-200">
                            {{ $e->data_devolucao ? $e->data_devolucao->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-4 py-2 border border-pink-200">{{ $e->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-sm text-gray-500 text-center">
        Histórico gerado pelo sistema da Biblioteca
    </div>
</div>
