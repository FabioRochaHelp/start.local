<x-layout title='Buscar Agendamentos'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateagencindex') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buscar Agendamentos</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Resultados da Busca</h6>
                        <a href="{{ route('ateagencindex') }}" class="ms-text-primary">Voltar</a>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($error))
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> {{ $error }}
                            </div>
                        @endif

                        @if(isset($searchType) && isset($searchValue))
                            <div class="alert alert-info">
                                <strong>Busca por {{ ucfirst(str_replace('-', ' ', $searchType)) }}:</strong> {{ $searchValue }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            @if(empty($agendamentos) || count($agendamentos) == 0)
                                <div class="alert alert-warning">
                                    <i class="material-icons">info</i> Nenhum agendamento encontrado com os critérios informados.
                                </div>
                            @else
                                <table class="table table-striped thead-primary w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Consulta</th>
                                            <th>Paciente</th>
                                            <th>Nome Consulta</th>
                                            <th>Nome Paciente</th>
                                            <th>CPF Paciente</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agendamentos as $item)
                                            @php
                                                // Verifica se os dados vêm estruturados (detalhes) ou planos
                                                if (isset($item['agendamento'])) {
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
                                                $nomeConsulta = $agendamento['CNOMECONSU'] ?? ($consulta['CNOMECONSU'] ?? 'N/A');
                                                $nomePaciente = $agendamento['CNOMEPACIE'] ?? ($paciente['CNOMEPACIE'] ?? 'N/A');
                                                $cpfPaciente = $agendamento['CCPF_PACIE'] ?? ($paciente['CCPF_PACIE'] ?? 'N/A');
                                            @endphp
                                            <tr>
                                                <td>{{ $id ?? 'N/A' }}</td>
                                                <td>{{ $nnumeconsu }}</td>
                                                <td>{{ $nnumepacie }}</td>
                                                <td>{{ $nomeConsulta }}</td>
                                                <td>{{ $nomePaciente }}</td>
                                                <td>{{ $cpfPaciente }}</td>
                                                <td>
                                                    @if($id)
                                                        <a href="{{ route('ateagencshow', ['id' => $id]) }}">
                                                            <button type="button" class="ms-btn-icon"
                                                                style="background-color: #00acb1;" name="button"
                                                                title="Ver Detalhes"><i class="material-icons"
                                                                    style="font-size: 18px; margin-left: 8px;">visibility</i></button>
                                                        </a>
                                                        <a href="{{ route('ateagencedit', ['id' => $id]) }}">
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

