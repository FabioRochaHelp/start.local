<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Alunos</h5>
            <a class="btn btn-primary" href="{{ route('alunos.create') }}">
                <i class="fas fa-plus"></i> Novo Aluno
            </a>
        </div>

        <div class="card-body">
        @if ($alunos->count())
            <div class="table-responsive">
                <table id="alunos-table" class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Matrícula</th>
                            <th>Nome</th>
                            <th>Turno</th>
                            <th>Situação</th>
                            <th>Ingresso</th>
                            <th width="150">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)
                            <tr>
                                <td>
                                    <img src="{{ $aluno->pessoa?->photo_url }}" alt="Foto"
                                        class="rounded-circle border" width="40" height="40">
                                </td>
                                <td>{{ $aluno->matricula }}</td>
                                <td>{{ $aluno->pessoa?->nome_completo }}</td>
                                <td data-turno="{{ $aluno->turno }}"><span
                                        class="badge bg-secondary">{{ $turnos[$aluno->turno] ?? $aluno->turno }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $aluno->situacao === 'ATIVO' ? 'success' : 'warning' }}"
                                        data-situacao="{{ $aluno->situacao }}">
                                        {{ $situacoes[$aluno->situacao] ?? $aluno->situacao }}
                                    </span>
                                </td>
                                <td>{{ optional($aluno->data_ingresso)->format('d/m/Y') }}</td>
                                <td>
                                    <a class="btn-sm btn-outline-info" title="Ver"
                                        href="{{ route('alunos.show', $aluno) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn-sm btn-outline-primary" title="Editar"
                                        href="{{ route('alunos.edit', $aluno) }}"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">Nenhum aluno encontrado</div>
        @endif
    </div>
</div>
</div>

@once
    @push('scripts')
        <script src="{{ asset('/assets/js/datatables.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (!window.jQuery || !$.fn.DataTable) return;

                const table = $('#alunos-table').DataTable({
                    destroy: true,
                    pageLength: 10,
                    order: [
                        [1, 'asc']
                    ], // matrícula
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                    },
                    columnDefs: [{
                            orderable: false,
                            targets: [0, 6]
                        } // foto e ações
                    ]
                });

                // Filtros externos
                $('#filter-turno').on('change', function() {
                    const val = this.value;
                    // Coluna Turno = index 3
                    table.column(3).search(val ? val : '', true, false).draw();
                });

                $('#filter-situacao').on('change', function() {
                    const val = this.value;
                    // Coluna Situação = index 4
                    table.column(4).search(val ? val : '', true, false).draw();
                });
            });
        </script>
    @endpush
@endonce
