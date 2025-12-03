<x-layout title='Buscar Consultas'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateconsu.index') }}">Consultas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buscar Consultas</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Resultados da Busca</h6>
                        <a href="{{ route('ateconsu.index') }}" class="ms-text-primary">Voltar</a>
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
                            @if(empty($consultas) || count($consultas) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhuma consulta encontrada com os critérios informados.
                                </div>
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <thead>
                                        <tr>
                                            <th>Número</th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Situação</th>
                                            <th>Especialidade</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($consultas as $consulta)
                                            <tr>
                                                <td>{{ $consulta['NNUMECONSU'] ?? 'N/A' }}</td>
                                                <td>{{ $consulta['CNOMECONSU'] ?? 'N/A' }}</td>
                                                <td>{{ $consulta['CTIPOCONSU'] ?? 'N/A' }}</td>
                                                <td>{{ $consulta['CSITUCONSU'] ?? 'N/A' }}</td>
                                                <td>{{ $consulta['NNUMEESPEC'] ?? 'N/A' }}</td>
                                                <td>
                                                    @if(isset($consulta['NNUMECONSU']))
                                                        <a href="{{ route('ateconsu.show', ['numero' => $consulta['NNUMECONSU']]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #00acb1;" name="button"
                                                                title="Ver Detalhes"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">visibility</i></button>
                                                        </a>
                                                        <a href="{{ route('ateconsu.edit', ['numero' => $consulta['NNUMECONSU']]) }}">
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

