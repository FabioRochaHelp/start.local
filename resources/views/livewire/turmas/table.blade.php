<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-chalkboard"></i> Turmas</h5>
            <a class="btn btn-primary" href="{{ route('turmas.create') }}">
                <i class="fas fa-plus"></i> Nova Turma
            </a>
        </div>

        <div class="card-body">
            @if($turmas->count())
                <div class="table-responsive">
                    <table id="turmas-table" class="table table-striped align-middle">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ano Letivo</th>
                            <th>Série</th>
                            <th>Turno</th>
                            <th>Capacidade</th>
                            <th>Sala</th>
                            <th>Professor Titular</th>
                            <th>Status</th>
                            <th width="150">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($turmas as $turma)
                            <tr>
                                <td>{{ $turma->nome }}</td>
                                <td>{{ $turma->ano_letivo }}</td>
                                <td>{{ $turma->serie }}</td>
                                <td><span class="badge bg-secondary">{{ $turnos[$turma->turno] ?? $turma->turno }}</span></td>
                                <td>{{ $turma->capacidade_maxima }}</td>
                                <td>{{ $turma->sala }}</td>
                                <td>{{ $turma->professorTitular?->nome_completo ?? '—' }}</td>
                                <td>
                                    <span class="badge {{ $turma->ativo ? 'bg-success' : 'bg-danger' }}">
                                        {{ $turma->ativo ? 'Ativa' : 'Inativa' }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn-sm btn-outline-info" title="Ver"
                                       href="{{ route('turmas.show', $turma) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn-sm btn-outline-primary" title="Editar"
                                       href="{{ route('turmas.edit', $turma) }}"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">Nenhuma turma encontrada</div>
            @endif
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('/assets/js/datatables.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (!window.jQuery || !$.fn.DataTable) return;
                if (!$('#turmas-table').length) return;

                $('#turmas-table').DataTable({
                    destroy: true,
                    pageLength: 10,
                    order: [[1, 'desc']], // ano letivo
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                    },
                    columnDefs: [
                        { orderable: false, targets: [8] }
                    ]
                });
            });
        </script>
    @endpush
@endonce

