<x-layout title='Lista de Agendamentos'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateagenc.index') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista de Agendamentos</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Lista de Agendamentos</h6>
                        <div>
                            <a href="{{ route('ateagenc.list') }}" class="ms-text-primary">Voltar</a>
                            <a href="{{ route('ateagenc.create') }}" class="ms-text-primary ms-3">Adicionar</a>
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
                                <strong>Total:</strong> {{ $pagination['total'] ?? 0 }} agendamentos | 
                                <strong>Exibindo:</strong> {{ count($agendamentos ?? []) }} resultados
                                @if(isset($completo) && $completo)
                                    | <strong>Modo:</strong> Completo (com JOINs)
                                @endif
                                @if(isset($detalhes) && $detalhes)
                                    | <strong>Modo:</strong> Detalhes Estruturados
                                @endif
                            </div>
                        @endif

                        <div class="table-responsive">
                            @if(empty($agendamentos) || count($agendamentos) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhum agendamento encontrado.
                                </div>
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Consulta</th>s
                                            <th>Paciente</th>
                                            @if((isset($completo) && $completo) || (isset($detalhes) && $detalhes))
                                                <th>Consultório</th>
                                                <th>Nome Paciente</th>
                                                <th>CPF Paciente</th>
                                            @endif
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agendamentos as $item)
                                            @php
                                                // Verifica se os dados vêm estruturados (detalhes) ou planos
                                                if (isset($detalhes) && $detalhes && isset($item['agendamento'])) {
                                                    $agendamento = $item['agendamento'] ?? [];
                                                    $consulta = $item['consulta'] ?? [];
                                                    $paciente = $item['paciente'] ?? [];
                                                } else {
                                                    $agendamento = $item;
                                                    $consulta = [];
                                                    $paciente = [];
                                                }
                                                
                                                $id = $agendamento['NNUMEGENC'] ?? $agendamento['NNUMEAGENC'] ?? null;
                                                $nnumeconsu = $agendamento['NNUMECONSU'] ?? ($consulta['NNUMECONSU'] ?? 'N/A');
                                                $nnumepacie = $agendamento['NNUMEPACIE'] ?? ($paciente['NNUMEPACIE'] ?? 'N/A');
                                                
                                                // Para modo completo ou detalhes, pega dados das entidades relacionadas
                                                $nomeConsulta = null;
                                                $nomePaciente = null;
                                                $cpfPaciente = null;
                                                
                                                if (isset($completo) && $completo) {
                                                    $nomeConsulta = $agendamento['CNOMECONSU'] ?? 'N/A';
                                                    $nomePaciente = $agendamento['CNOMEPACIE'] ?? 'N/A';
                                                    $cpfPaciente = $agendamento['CCPF_PACIE'] ?? 'N/A';
                                                } elseif (isset($detalhes) && $detalhes) {
                                                    $nomeConsulta = $consulta['CNOMECONSU'] ?? 'N/A';
                                                    $nomePaciente = $paciente['CNOMEPACIE'] ?? 'N/A';
                                                    $cpfPaciente = $paciente['CCPF_PACIE'] ?? 'N/A';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $id ?? 'N/A' }}</td>
                                                <td>{{ $nnumeconsu }}</td>
                                                <td>{{ $nnumepacie }}</td>
                                                @if((isset($completo) && $completo) || (isset($detalhes) && $detalhes))
                                                    <td>{{ $nomeConsulta }}</td>
                                                    <td>{{ $nomePaciente }}</td>
                                                    <td>{{ $cpfPaciente }}</td>
                                                @endif
                                                <td>
                                                    @if($id)
                                                        <a href="{{ route('ateagenc.show', ['id' => $id]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #00acb1;" name="button"
                                                                title="Ver Detalhes"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">visibility</i></button>
                                                        </a>
                                                        <a href="{{ route('ateagenc.edit', ['id' => $id]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #ffc107;" name="button"
                                                                title="Editar"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">edit</i></button>
                                                        </a>
                                                        <a href="{{ route('ateagenc.delete', ['id' => $id]) }}"
                                                           onclick="return confirm('Tem certeza que deseja excluir este agendamento?')">
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
                                    @php
                                        $params = [];
                                        if (isset($completo) && $completo) {
                                            $params['completo'] = '1';
                                        }
                                        if (isset($detalhes) && $detalhes) {
                                            $params['detalhes'] = '1';
                                        }
                                        $queryString = !empty($params) ? '&' . http_build_query($params) : '';
                                    @endphp
                                    @if(($pagination['offset'] ?? 0) > 0)
                                        <a href="{{ route('ateagenc.list', array_merge(['offset' => max(0, ($pagination['offset'] ?? 0) - ($pagination['limit'] ?? 100)), 'limit' => $pagination['limit'] ?? 100], $params)) }}" 
                                           class="btn btn-secondary">
                                            <i class="material-icons">arrow_back</i> Anterior
                                        </a>
                                    @endif
                                    @if(($pagination['offset'] ?? 0) + count($agendamentos ?? []) < ($pagination['total'] ?? 0))
                                        <a href="{{ route('ateagenc.list', array_merge(['offset' => ($pagination['offset'] ?? 0) + ($pagination['limit'] ?? 100), 'limit' => $pagination['limit'] ?? 100], $params)) }}" 
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

