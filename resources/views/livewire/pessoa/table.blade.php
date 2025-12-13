<div>
    <h1>Pessoas</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->nome_completo }}</td>
                    <td>{{ $pessoa->tipo }}</td>
                    <td>{{ $pessoa->cpf }}</td>
                    <td>{{ $pessoa->email }}</td>
                    <td>{{ $pessoa->telefone }}</td>
                    <td>{{ $pessoa->status }}</td>
                    <td>
                        <a href="{{ route('pessoas.edit', $pessoa) }}" class="btn-primary">Editar</a>
                        <a href="{{ route('pessoas.destroy', $pessoa) }}" class="btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pessoas->links() }}
</div>
