<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" class="form-control" placeholder="Nome da categoria" required>

    <textarea name="descricao" class="form-control mt-2" placeholder="Descrição (opcional)"></textarea>

    <button type="submit" class="btn btn-success mt-2">Salvar</button>
</form>
