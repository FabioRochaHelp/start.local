<x-layout title="Visualizar Turma">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-chalkboard"></i> {{ $turma->nome }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('turmas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Ano letivo:</label>
                        <div>{{ $turma->ano_letivo }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Série:</label>
                        <div>{{ $turma->serie }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Turno:</label>
                        <div><span class="badge bg-secondary">{{ \App\Models\Turma::TURNOS[$turma->turno] ?? $turma->turno }}</span></div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Capacidade máxima:</label>
                        <div>{{ $turma->capacidade_maxima }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sala:</label>
                        <div>{{ $turma->sala }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Professor titular:</label>
                        <div>{{ $turma->professorTitular?->nome_completo ?? '—' }}</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Status:</label>
                        <div>
                            <span class="badge {{ $turma->ativo ? 'bg-success' : 'bg-danger' }}">
                                {{ $turma->ativo ? 'Ativa' : 'Inativa' }}
                            </span>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <form method="POST" action="{{ route('turmas.destroy', $turma) }}" onsubmit="return confirm('Excluir esta turma?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fas fa-trash"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>


