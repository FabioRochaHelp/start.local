<div>
    <!-- Tabela -->
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" onclick="window.location.href='{{ route('pessoas.create') }}'">
                Nova Pessoa
            </button>
        </div>
        <div class="card-body">
            @if($pessoas->count())
                <div class="table-responsive">
                    <table id="pessoas-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Status</th>
                            <th width="150">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pessoas as $pessoa)
                            <tr>
                                <td><img src="{{ $pessoa->photo_url }}" alt="Foto" class="rounded-circle" width="40" height="40"></td>
                                <td>{{ $pessoa->nome_completo }}</td>
                                <td><span class="badge bg-secondary">{{ $tipos[$pessoa->tipo] }}</span></td>
                                <td class="cpf-mask">{{ $pessoa->cpf_formatado }}</td>
                                <td>{{ $pessoa->email }}</td>
                                <td class="telefone-mask">{{ $pessoa->telefone_formatado }}</td>
                                <td>
                                    <span class="badge {{ $pessoa->ativo ? 'bg-success' : 'bg-danger' }}">
                                        {{ $pessoa->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn-sm btn-outline-info" title="Ver"
                                       href="{{ route('pessoas.show', $pessoa) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn-sm btn-outline-primary" title="Editar"
                                       href="{{ route('pessoas.edit', $pessoa) }}"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">Nenhuma pessoa encontrada</div>
            @endif
        </div>
    </div>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    @endpush
@endonce

@once
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

        <script>
            function loadPessoasTable() {
                const selector = '#pessoas-table';
                if (!$(selector).length) return;

                $(selector).DataTable({
                    destroy: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                    },
                    pageLength: 10,
                    order: []
                });
            }

            document.addEventListener('DOMContentLoaded', loadPessoasTable);

            document.addEventListener('livewire:init', () => {
                Livewire.on('rendered', loadPessoasTable);
                Livewire.hook('element.updated', loadPessoasTable);
            });
        </script>
    @endpush
@endonce
