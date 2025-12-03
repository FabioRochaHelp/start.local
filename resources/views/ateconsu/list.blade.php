<x-layout title='Lista de Consultas'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateconsu.index') }}">Consultas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista de Consultas</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Consultas</h6>
                        <div>
                            <a href="{{ route('ateconsu.index') }}" class="ms-text-primary">Voltar</a>
                            <a href="{{ route('ateconsu.create') }}" class="ms-text-primary ms-3">Adicionar</a>
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
                                <strong>Total:</strong> {{ $pagination['total'] ?? 0 }} consultas | 
                                <strong>Exibindo:</strong> {{ count($consultas ?? []) }} resultados
                            </div>
                        @endif

                        <div class="table-responsive">
                            @if(empty($consultas) || count($consultas) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhuma consulta encontrada.
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
                                                        <a href="{{ route('ateconsu.delete', ['numero' => $consulta['NNUMECONSU']]) }}"
                                                           onclick="return confirm('Tem certeza que deseja excluir esta consulta?')">
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
                                        <a href="{{ route('ateconsu.list', ['offset' => max(0, ($pagination['offset'] ?? 0) - ($pagination['limit'] ?? 100)), 'limit' => $pagination['limit'] ?? 100]) }}" 
                                           class="btn btn-secondary">
                                            <i class="material-icons">arrow_back</i> Anterior
                                        </a>
                                    @endif
                                    @if(($pagination['offset'] ?? 0) + count($consultas ?? []) < ($pagination['total'] ?? 0))
                                        <a href="{{ route('ateconsu.list', ['offset' => ($pagination['offset'] ?? 0) + ($pagination['limit'] ?? 100), 'limit' => $pagination['limit'] ?? 100]) }}" 
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

