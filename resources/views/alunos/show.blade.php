<x-layout title="Visualizar Aluno">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $aluno->pessoa?->photo_url }}" alt="Foto" class="rounded-circle border" width="80" height="80">
                <div>
                    <h1 class="mb-0"><i class="fas fa-user-graduate"></i> {{ $aluno->pessoa?->nome_completo }}</h1>
                    <div class="text-muted">Matrícula: {{ $aluno->matricula }}</div>
                </div>
            </div>
            <div>
                <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Dados do Aluno</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Turno:</label>
                                <div><span class="badge bg-secondary">{{ \App\Models\Aluno::TURNOS[$aluno->turno] ?? $aluno->turno }}</span></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Situação:</label>
                                <div><span class="badge bg-{{ $aluno->situacao === 'ATIVO' ? 'success' : 'warning' }}">{{ \App\Models\Aluno::SITUACOES[$aluno->situacao] ?? $aluno->situacao }}</span></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Data de Ingresso:</label>
                                <div>{{ optional($aluno->data_ingresso)->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Responsável Financeiro:</label>
                            <div>{{ $aluno->responsavelFinanceiro?->nome_completo ?? '—' }}</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Observações:</label>
                            <div>{{ $aluno->observacoes ?? '—' }}</div>
                        </div>

                        <hr>
                        <h6 class="mb-3">Dados Pessoais</h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">CPF:</label>
                                <div class="cpf-mask">{{ $aluno->pessoa?->cpf_formatado }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data de Nascimento:</label>
                                <div>{{ optional($aluno->pessoa?->data_nascimento)->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email:</label>
                                <div><a href="mailto:{{ $aluno->pessoa?->email }}">{{ $aluno->pessoa?->email }}</a></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Telefone:</label>
                                <div class="telefone-mask">{{ $aluno->pessoa?->telefone_formatado }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Endereço:</label>
                            <div>{{ $aluno->pessoa?->endereco }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>


