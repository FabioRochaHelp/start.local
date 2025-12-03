<x-layout title='Lista de Pacientes'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('atepacie.index') }}">Pacientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista de Pacientes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Pacientes</h6>
                        <div>
                            <a href="{{ route('atepacie.index') }}" class="ms-text-primary">Voltar</a>
                            <a href="{{ route('atepacie.create') }}" class="ms-text-primary ms-3">Adicionar</a>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($error))
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> {{ $error }}
                            </div>
                        @endif

                        @if(isset($pagination) && !empty($pagination))
                            <div class="alert alert-info">
                                <strong>Total:</strong> {{ $pagination['total'] ?? 0 }} pacientes | 
                                <strong>Exibindo:</strong> {{ count($pacientes ?? []) }} resultados
                            </div>
                        @endif

                        <div class="table-responsive">
                            @if(empty($pacientes) || count($pacientes) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhum paciente encontrado.
                                </div>
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Nome</th>
                                            <th>CPF</th>
                                            <th>Documento</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pacientes as $paciente)
                                            <tr>
                                                <td>{{ $paciente['NNUMEPACIE'] ?? 'N/A' }}</td>
                                                <td>{{ $paciente['CNOMEPACIE'] ?? 'N/A' }}</td>
                                                <td>{{ $paciente['CCPF_PACIE'] ?? 'N/A' }}</td>
                                                <td>{{ $paciente['CDOCUPACIE'] ?? 'N/A' }}</td>
                                                <td>
                                                    @if(isset($paciente['NNUMEPACIE']))
                                                        <a href="{{ route('atepacie.show', ['numero' => $paciente['NNUMEPACIE']]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #00acb1;" name="button"
                                                                title="Ver Detalhes"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">visibility</i></button>
                                                        </a>
                                                        <a href="{{ route('atepacie.edit', ['numero' => $paciente['NNUMEPACIE']]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #ffc107;" name="button"
                                                                title="Editar"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">edit</i></button>
                                                        </a>
                                                        <a href="{{ route('atepacie.delete', ['numero' => $paciente['NNUMEPACIE']]) }}"
                                                           onclick="return confirm('Tem certeza que deseja excluir este paciente?')">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #dc3545;" name="button"
                                                                title="Excluir"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">delete</i></button>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                        @if(isset($pagination) && !empty($pagination))
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span>Página {{ floor(($pagination['offset'] ?? 0) / ($pagination['limit'] ?? 100)) + 1 }}</span>
                                </div>
                                <div>
                                    @if(($pagination['offset'] ?? 0) > 0)
                                        <a href="{{ route('atepacie.list', ['offset' => max(0, ($pagination['offset'] ?? 0) - ($pagination['limit'] ?? 100)), 'limit' => $pagination['limit'] ?? 100]) }}" 
                                           class="btn btn-secondary">
                                            <i class="material-icons">arrow_back</i> Anterior
                                        </a>
                                    @endif
                                    @if(($pagination['offset'] ?? 0) + count($pacientes ?? []) < ($pagination['total'] ?? 0))
                                        <a href="{{ route('atepacie.list', ['offset' => ($pagination['offset'] ?? 0) + ($pagination['limit'] ?? 100), 'limit' => $pagination['limit'] ?? 100]) }}" 
                                           class="btn btn-secondary">
                                            Próxima <i class="material-icons">arrow_forward</i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

