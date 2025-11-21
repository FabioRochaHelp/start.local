<x-layout title='Buscar Pacientes'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateatend.index') }}">Atendimento</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buscar Pacientes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Resultados da Busca</h6>
                        <a href="{{ route('ateatend.index') }}" class="ms-text-primary">Voltar</a>
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
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Documento</th>
                                            <th>Data de Cadastro</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pacientes as $paciente)
                                            <tr>
                                                <td>{{ $paciente['id'] ?? 'N/A' }}</td>
                                                <td>{{ $paciente['nome'] ?? 'N/A' }}</td>
                                                <td>{{ $paciente['documento'] ?? 'N/A' }}</td>
                                                <td>{{ isset($paciente['created_at']) ? date('d/m/Y', strtotime($paciente['created_at'])) : 'N/A' }}</td>
                                                <td>
                                                    @if(isset($paciente['id']))
                                                        <a href="{{ route('ateatend.search.id', ['id' => $paciente['id']]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #00acb1;" name="button"
                                                                title="Ver Detalhes"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">visibility</i></button>
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

