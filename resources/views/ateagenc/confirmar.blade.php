<x-guest-confirmar-layout title='Confirmar Agendamento'>
    <div class="row justify-content-center mx-0">
        <div class="col-12 col-md-10 col-lg-8 px-3 px-md-4">
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6 class="mb-0">Confirmar Agendamento</h6>
                    </div>
                    <div class="ms-panel-body p-3 p-md-4">
                        @if(session('toast_message'))
                            <div class="alert alert-{{ session('toast_type') === 'success' ? 'success' : (session('toast_type') === 'error' ? 'danger' : 'warning') }}">
                                <i class="material-icons">{{ session('toast_type') === 'success' ? 'check_circle' : (session('toast_type') === 'error' ? 'error' : 'warning') }}</i>
                                {{ session('toast_message') }}
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
                            @endphp

                            <div class="row g-3 g-md-4">
                                <!-- Informações do Paciente -->
                                @if(!empty($pacienteData))
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-3 p-md-4">
                                                <h5 class="card-title mb-3 mb-md-4 d-flex align-items-center">
                                                    <i class="material-icons me-2">person</i> 
                                                    <span class="fs-6">Dados do Paciente</span>
                                                </h5>
                                                <div class="row g-2 g-md-3">
                                                    <div class="col-12 col-md-6">
                                                        <div class="mb-2 mb-md-3">
                                                            <strong class="d-block mb-1 text-muted small">Nome:</strong>
                                                            <div class="fs-6">{{ $pacienteData['CNOMEPACIE'] ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    @if(isset($pacienteData['CCPFCPACIE']))
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-2 mb-md-3">
                                                                <strong class="d-block mb-1 text-muted small">CPF:</strong>
                                                                <div class="fs-6">{{ $pacienteData['CCPFCPACIE'] ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(isset($pacienteData['CFCELPACIE']) || isset($pacienteData['CFONEPACIE']))
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-2 mb-md-3">
                                                                <strong class="d-block mb-1 text-muted small">Telefone:</strong>
                                                                <div class="fs-6">{{ $pacienteData['CFCELPACIE'] ?? $pacienteData['CFONEPACIE'] ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Informações da Consulta -->
                                @if(!empty($consultaData))
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-3 p-md-4">
                                                <h5 class="card-title mb-3 mb-md-4 d-flex align-items-center">
                                                    <i class="material-icons me-2">medical_services</i> 
                                                    <span class="fs-6">Dados da Consulta</span>
                                                </h5>
                                                <div class="row g-2 g-md-3">
                                                    <div class="col-12 col-md-6">
                                                        <div class="mb-2 mb-md-3">
                                                            <strong class="d-block mb-1 text-muted small">Nome da Consulta:</strong>
                                                            <div class="fs-6">{{ $consultaData['CNOMECONSU'] ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    @if(isset($consultaData['CTIPOCONSU']))
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-2 mb-md-3">
                                                                <strong class="d-block mb-1 text-muted small">Tipo:</strong>
                                                                <div class="fs-6">{{ $consultaData['CTIPOCONSU'] ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Informações do Agendamento -->
                                @if(!empty($agendamentoData))
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-3 p-md-4">
                                                <h5 class="card-title mb-3 mb-md-4 d-flex align-items-center">
                                                    <i class="material-icons me-2">event</i> 
                                                    <span class="fs-6">Dados do Agendamento</span>
                                                </h5>
                                                <div class="row g-2 g-md-3">
                                                    <div class="col-12 col-md-6">
                                                        <div class="mb-2 mb-md-3">
                                                            <strong class="d-block mb-1 text-muted small">Data:</strong>
                                                            <div class="fs-6">
                                                                @if(isset($agendamentoData['DDATAAGENC']))
                                                                    {{ \Carbon\Carbon::parse($agendamentoData['DDATAAGENC'])->format('d/m/Y') }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="mb-2 mb-md-3">
                                                            <strong class="d-block mb-1 text-muted small">Horário:</strong>
                                                            <div class="fs-6">{{ $agendamentoData['CHORAAGENC'] ?? 'N/A' }}</div>
                                                        </div>
                                                    </div>
                                                    @if(isset($agendamentoData['CSITUAGENC']))
                                                        <div class="col-12 col-md-6">
                                                            <div class="mb-2 mb-md-3">
                                                                <strong class="d-block mb-1 text-muted small">Situação:</strong>
                                                                <div class="fs-6">{{ $agendamentoData['CSITUAGENC'] ?? 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Botões de Ação -->
                                <div class="col-12">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-body p-3 p-md-4 text-center">
                                            <h5 class="card-title mb-3 mb-md-4 fs-6">Confirme ou cancele seu agendamento</h5>
                                            <form action="{{ route('ateagenc.processar.confirmacao', ['id' => $id]) }}" method="POST" id="formConfirmacao">
                                                @csrf
                                                <div class="d-flex flex-column flex-md-row justify-content-center gap-2 gap-md-3">
                                                    <button type="submit" name="acao" value="confirmar" class="btn btn-success btn-lg flex-fill flex-md-grow-0 px-4 py-3">
                                                        <i class="material-icons align-middle">check_circle</i> 
                                                        <span class="ms-1 d-inline-block">Confirmar</span>
                                                    </button>
                                                    <button type="submit" name="acao" value="cancelar" class="btn btn-danger btn-lg flex-fill flex-md-grow-0 px-4 py-3">
                                                        <i class="material-icons align-middle">cancel</i> 
                                                        <span class="ms-1 d-inline-block">Cancelar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger mb-0">
                                <i class="material-icons align-middle">error</i> 
                                <span class="ms-2">Agendamento não encontrado.</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('formConfirmacao')?.addEventListener('submit', function(e) {
            const button = e.submitter;
            const acao = button.value;
            const mensagem = acao === 'confirmar' 
                ? 'Tem certeza que deseja confirmar este agendamento?' 
                : 'Tem certeza que deseja cancelar este agendamento?';
            
            if (!confirm(mensagem)) {
                e.preventDefault();
                return false;
            }
        });
    </script>
</x-guest-confirmar-layout>

