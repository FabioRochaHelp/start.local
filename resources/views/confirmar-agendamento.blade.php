<x-guest-confirmar-layout title='Confirmar Agendamento'>
    <div class="row justify-content-center mx-0">
        <div class="col-12 col-md-10 col-lg-8 px-3 px-md-4">
            <div class="ms-panel">
                <div class="ms-panel-header ms-panel-custome">
                    <h6 class="mb-0">Confirmar Agendamento</h6>
                </div>
                <div class="ms-panel-body p-3 p-md-4">
                    @if(session('toast_message'))
                        <div class="alert alert-{{ session('toast_type') === 'success' ? 'success' : 'danger' }}">
                            <i class="material-icons">{{ session('toast_type') === 'success' ? 'check_circle' : 'error' }}</i>
                            {{ session('toast_message') }}
                        </div>
                    @endif

                    @if(isset($agendamento) && !empty($agendamento))
                        @php
                            // Extrair dados do agendamento
                            $isStructured = isset($agendamento['agendamento']);
                            $agendamentoData = $isStructured ? ($agendamento['agendamento'] ?? []) : $agendamento;
                            $consultaData = $agendamento['consulta'] ?? [];
                            $pacienteData = $agendamento['paciente'] ?? [];
                            
                            // Gerar ID único para o registro
                            $nnumeflate = time() . rand(100, 999);
                        @endphp

                        <!-- Dados do Agendamento (Visual) -->
                        <div class="row g-3 g-md-4">
                            @include('partials.dados-paciente', ['paciente' => $pacienteData])
                            @include('partials.dados-consulta', ['consulta' => $consultaData])
                            @include('partials.dados-agendamento', ['agendamento' => $agendamentoData])

                            <!-- Formulário de Ação -->
                            <div class="col-12">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body p-3 p-md-4 text-center">
                                        <h5 class="card-title mb-3 mb-md-4 fs-6">
                                            Confirme ou cancele seu agendamento
                                        </h5>
                                        
                                        <form action="{{ route('ateflate.processar') }}" method="POST" 
                                              id="formConfirmacao" class="needs-validation" novalidate>
                                            @csrf
                                            
                                            <!-- Campo Hidden para Ação -->
                                            <input type="hidden" name="acao" id="inputAcao" value="">
                                            
                                            <!-- Campos Ocultos com Dados do Banco -->
                                            <input type="hidden" name="nnumeflate" value="{{ $nnumeflate }}">
                                            <input type="hidden" name="nnumeagenc" value="{{ $agendamentoData['NNUMEAGENC'] ?? 0 }}">
                                            <input type="hidden" name="nnumeagend" value="{{ $agendamentoData['NNUMEAGEND'] ?? 0 }}">
                                            <input type="hidden" name="ddataflate" 
                                                   value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s.u') }}">
                                            <input type="hidden" name="cobseflate" id="inputObservacao" 
                                                   value="Agendamento confirmado pelo paciente">
                                            <input type="hidden" name="nnumeusua" 
                                                   value="{{ auth()->check() ? auth()->id() : 888 }}">
                                            
                                            <!-- Campos com Valor Padrão -->
                                            <input type="hidden" name="nnumefluxo" value="0">
                                            <input type="hidden" name="nnumeatend" value="0">
                                            <input type="hidden" name="nnumecagen" value="0">
                                            <input type="hidden" name="nnumeguia" value="0">
                                            <input type="hidden" name="nnumemensa" value="0">
                                            <input type="hidden" name="rnum" value="0">
                                            
                                            <!-- ID do Agendamento Original -->
                                            <input type="hidden" name="agendamento_id" value="{{ $id }}">

                                            <div class="d-flex flex-column flex-md-row justify-content-center gap-2 gap-md-3">
                                                <button type="button" 
                                                        onclick="processarAcao('confirmar')" 
                                                        class="btn btn-success btn-lg flex-fill flex-md-grow-0 px-4 py-3">
                                                    <i class="material-icons align-middle">check_circle</i> 
                                                    <span class="ms-1">Confirmar Agendamento</span>
                                                </button>
                                                
                                                <button type="button" 
                                                        onclick="processarAcao('cancelar')" 
                                                        class="btn btn-danger btn-lg flex-fill flex-md-grow-0 px-4 py-3">
                                                    <i class="material-icons align-middle">cancel</i> 
                                                    <span class="ms-1">Cancelar Agendamento</span>
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
                            <span class="ms-2">Agendamento não encontrado ou já processado.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function processarAcao(acao) {
            // Textos de confirmação
            const textos = {
                confirmar: {
                    titulo: 'Confirmar Agendamento',
                    mensagem: 'Tem certeza que deseja CONFIRMAR este agendamento?',
                    observacao: 'Agendamento confirmado pelo paciente',
                    icone: 'check_circle'
                },
                cancelar: {
                    titulo: 'Cancelar Agendamento', 
                    mensagem: 'Tem certeza que deseja CANCELAR este agendamento?',
                    observacao: 'Agendamento cancelado pelo paciente',
                    icone: 'cancel'
                }
            };
            
            const config = textos[acao];
            
            if (!confirm(config.mensagem)) {
                return false;
            }
            
            // Atualizar campos ocultos
            document.getElementById('inputAcao').value = acao;
            document.getElementById('inputObservacao').value = config.observacao;
            
            // Feedback visual
            const botao = event.target;
            const textoOriginal = botao.innerHTML;
            botao.innerHTML = `
                <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                Processando...
            `;
            botao.disabled = true;
            
            // Desabilitar o outro botão
            const outroBotao = acao === 'confirmar' 
                ? document.querySelector('button[onclick*="cancelar"]')
                : document.querySelector('button[onclick*="confirmar"]');
            outroBotao.disabled = true;
            
            // Enviar formulário
            document.getElementById('formConfirmacao').submit();
            
            return true;
        }
        
        // Validação do formulário
        (function() {
            'use strict';
            const form = document.getElementById('formConfirmacao');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();
    </script>
</x-guest-confirmar-layout>