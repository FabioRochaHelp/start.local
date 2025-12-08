<x-layout title='Detalhes do Agendamento'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateagenc.list') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Detalhes do Agendamento</h6>
                        <div>
                            <a href="{{ route('ateagenc.list') }}" class="ms-text-primary">Voltar</a>
                            @if(isset($agendamento))
                                @php
                                    $isStructured = isset($agendamento['agendamento']);
                                    $agendamentoData = $isStructured ? ($agendamento['agendamento'] ?? []) : $agendamento;
                                    $id = $agendamentoData['NNUMEGENC'] ?? $agendamentoData['NNUMEAGENC'] ?? null;
                                @endphp
                                @if($id)
                                    <a href="{{ route('ateagenc.edit', ['id' => $id]) }}" class="ms-text-primary ms-3">Editar</a>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($error))
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> {{ $error }}
                            </div>
                        @endif

                        @if(isset($agendamento) && !empty($agendamento))
                            @php
                                // Verifica se os dados vêm estruturados
                                $isStructured = isset($agendamento['agendamento']) || isset($agendamento['consulta']) || isset($agendamento['paciente']);
                                
                                if ($isStructured) {
                                    $agendamentoData = $agendamento['agendamento'] ?? [];
                                    $consultaData = $agendamento['consulta'] ?? [];
                                    $pacienteData = $agendamento['paciente'] ?? [];
                                } else {
                                    $agendamentoData = $agendamento;
                                    $consultaData = [];
                                    $pacienteData = [];
                                }
                                
                                $id = $agendamentoData['NNUMEGENC'] ?? $agendamentoData['NNUMEAGENC'] ?? null;
                            @endphp
                            
                            @if($isStructured)
                                <!-- Dados Estruturados -->
                                <div class="row">
                                    <!-- Agendamento -->
                                    @if(!empty($agendamentoData))
                                        <div class="col-md-12 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4">
                                                        <i class="material-icons">event</i> Dados do Agendamento
                                                    </h5>
                                                    <div class="row">
                                                        @foreach($agendamentoData as $key => $value)
                                                            <div class="col-md-6 mb-3">
                                                                <strong>{{ $key }}:</strong>
                                                                <div class="mt-1">
                                                                    @if(is_array($value))
                                                                        <pre class="bg-light p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                                    @elseif(is_bool($value))
                                                                        {{ $value ? 'Sim' : 'Não' }}
                                                                    @else
                                                                        {{ $value ?? 'N/A' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Consulta -->
                                    @if(!empty($consultaData))
                                        <div class="col-md-12 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4">
                                                        <i class="material-icons">medical_services</i> Dados da Consulta
                                                    </h5>
                                                    <div class="row">
                                                        @foreach($consultaData as $key => $value)
                                                            <div class="col-md-6 mb-3">
                                                                <strong>{{ $key }}:</strong>
                                                                <div class="mt-1">
                                                                    @if(is_array($value))
                                                                        <pre class="bg-light p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                                    @elseif(is_bool($value))
                                                                        {{ $value ? 'Sim' : 'Não' }}
                                                                    @else
                                                                        {{ $value ?? 'N/A' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Paciente -->
                                    @if(!empty($pacienteData))
                                        <div class="col-md-12 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4">
                                                        <i class="material-icons">person</i> Dados do Paciente
                                                    </h5>
                                                    <div class="row">
                                                        @foreach($pacienteData as $key => $value)
                                                            <div class="col-md-6 mb-3">
                                                                <strong>{{ $key }}:</strong>
                                                                <div class="mt-1">
                                                                    @if(is_array($value))
                                                                        <pre class="bg-light p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                                    @elseif(is_bool($value))
                                                                        {{ $value ? 'Sim' : 'Não' }}
                                                                    @else
                                                                        {{ $value ?? 'N/A' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <!-- Dados Planos -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            <i class="material-icons">event</i> Informações do Agendamento
                                        </h5>
                                        <div class="row">
                                            @foreach($agendamentoData as $key => $value)
                                                <div class="col-md-6 mb-3">
                                                    <strong>{{ $key }}:</strong>
                                                    <div class="mt-1">
                                                        @if(is_array($value))
                                                            <pre class="bg-light p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                        @elseif(is_bool($value))
                                                            {{ $value ? 'Sim' : 'Não' }}
                                                        @else
                                                            {{ $value ?? 'N/A' }}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                <i class="material-icons">info</i> Nenhum dado do agendamento disponível.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

