<x-layout title='Buscar Pacientes'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('atepacie.index') }}">Pacientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buscar Pacientes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Resultados da Busca</h6>
                        <a href="{{ route('atepacie.index') }}" class="ms-text-primary">Voltar</a>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($error))
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> {{ $error }}
                            </div>
                        @endif

                        @if(isset($searchType) && isset($searchValue))
                            <div class="alert alert-info">
                                <strong>Busca por {{ ucfirst($searchType) }}:</strong> {{ $searchValue }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            @if(empty($pacientes) || count($pacientes) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhum paciente encontrado com os critérios informados.
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
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

