<x-layout title='Envio de Mensagens'>
    <div class="ms-content-wrapper">
        <div class="row">
            <!-- Verificar Status da Sessão -->
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="ms-panel">
                    <div class="ms-panel-header d-flex justify-content-between">
                        <h6>Verificar Status da Sessão</h6>
                        <button type="button" class="btn btn-info btn-sm" id="checkStatusButton">
                            <i class="material-icons">refresh</i> Verificar Status
                        </button>
                    </div>
                    <div class="ms-panel-body">
                        <div class="form-group">
                            <label for="statusSessionName">Nome da Sessão</label>
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control" 
                                       id="statusSessionName" 
                                       value="fabio" 
                                       placeholder="Ex: fabio">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info" id="checkStatusBtn">
                                        <i class="material-icons">search</i> Verificar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Loading State Status -->
                        <div id="loadingStatusState" class="text-center py-3" style="display: none;">
                            <div class="spinner-border text-info" role="status">
                                <span class="sr-only">Verificando...</span>
                            </div>
                            <p class="mt-2">Verificando status da sessão...</p>
                        </div>

                        <!-- Status Result -->
                        <div id="statusResult" style="display: none;">
                            <div class="card mt-3" id="statusCard">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <i class="material-icons" id="statusIcon" style="font-size: 48px;"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Status da Sessão</h5>
                                            <p class="mb-0" id="statusText"></p>
                                            <small class="text-muted" id="statusSessionNameText"></small>
                                        </div>
                                    </div>
                                    <pre id="statusResponse" class="mt-3 bg-light p-2 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"></pre>
                                </div>
                            </div>
                        </div>

                        <!-- Error Status -->
                        <div id="errorStatusState" class="alert alert-danger mt-3" style="display: none;">
                            <h6><i class="material-icons">error</i> Erro ao Verificar Status</h6>
                            <p class="mb-0" id="errorStatusText"></p>
                            <pre id="errorStatusResponse" class="mt-2 bg-light p-2 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enviar Mensagem -->
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <h6>Enviar Mensagem</h6>
                    </div>
                    <div class="ms-panel-body">
                        <form id="messageForm">
                            <div class="form-group">
                                <label for="sessionName">Nome da Sessão <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control" 
                                       id="sessionName" 
                                       name="sessionName" 
                                       value="session1" 
                                       required
                                       placeholder="Ex: session1">
                                <small class="form-text text-muted">Nome da sessão do WhatsApp</small>
                            </div>

                            <div class="form-group">
                                <label for="number">Número do Destinatário <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control" 
                                       id="number" 
                                       name="number" 
                                       required
                                       placeholder="Ex: 556334140378 (com código do país)">
                                <small class="form-text text-muted">Número com código do país (apenas dígitos)</small>
                            </div>

                            <div class="form-group">
                                <label for="text">Mensagem <span class="text-danger">*</span></label>
                                <textarea class="form-control" 
                                          id="text" 
                                          name="text" 
                                          rows="5" 
                                          required
                                          placeholder="Digite sua mensagem aqui..."></textarea>
                                <small class="form-text text-muted">Suporta quebras de linha (\n)</small>
                            </div>

                            <button type="submit" class="btn btn-primary" id="sendButton">
                                <i class="material-icons">send</i> Enviar Mensagem
                            </button>
                            <button type="button" class="btn btn-secondary" id="clearButton">
                                <i class="material-icons">clear</i> Limpar
                            </button>
                        </form>

                        <!-- Loading State -->
                        <div id="loadingState" class="text-center py-3" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Enviando...</span>
                            </div>
                            <p class="mt-2">Enviando mensagem...</p>
                        </div>

                        <!-- Success Message -->
                        <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                            <h6><i class="material-icons">check_circle</i> Mensagem Enviada com Sucesso!</h6>
                            <p class="mb-0" id="successText"></p>
                            <pre id="successResponse" class="mt-2 bg-light p-2 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"></pre>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="alert alert-danger mt-3" style="display: none;">
                            <h6><i class="material-icons">error</i> Erro ao Enviar Mensagem</h6>
                            <p class="mb-0" id="errorText"></p>
                            <pre id="errorResponse" class="mt-2 bg-light p-2 rounded" style="max-height: 200px; overflow-y: auto; font-size: 12px;"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('messageForm');
            const sendButton = document.getElementById('sendButton');
            const clearButton = document.getElementById('clearButton');
            const loadingState = document.getElementById('loadingState');
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            // Enviar formulário
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Ocultar mensagens anteriores
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                loadingState.style.display = 'block';
                sendButton.disabled = true;

                // Coletar dados do formulário
                const formData = {
                    sessionName: document.getElementById('sessionName').value,
                    number: document.getElementById('number').value,
                    text: document.getElementById('text').value
                };

                try {
                    const response = await fetch('/api/message/send', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(formData)
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Sucesso
                        successMessage.style.display = 'block';
                        document.getElementById('successText').textContent = data.message || 'Mensagem enviada com sucesso!';
                        document.getElementById('successResponse').textContent = JSON.stringify(data, null, 2);
                        
                        // Limpar formulário após sucesso (opcional)
                        // form.reset();
                    } else {
                        // Erro
                        errorMessage.style.display = 'block';
                        document.getElementById('errorText').textContent = data.error || 'Erro desconhecido';
                        document.getElementById('errorResponse').textContent = JSON.stringify(data, null, 2);
                    }

                } catch (error) {
                    errorMessage.style.display = 'block';
                    document.getElementById('errorText').textContent = 'Erro de conexão: ' + error.message;
                    document.getElementById('errorResponse').textContent = error.stack || error.toString();
                } finally {
                    loadingState.style.display = 'none';
                    sendButton.disabled = false;
                }
            });

            // Limpar formulário
            clearButton.addEventListener('click', function() {
                form.reset();
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
            });

            // Verificar Status da Sessão
            const checkStatusButton = document.getElementById('checkStatusButton');
            const checkStatusBtn = document.getElementById('checkStatusBtn');
            const loadingStatusState = document.getElementById('loadingStatusState');
            const statusResult = document.getElementById('statusResult');
            const errorStatusState = document.getElementById('errorStatusState');
            const statusSessionNameInput = document.getElementById('statusSessionName');

            function checkSessionStatus() {
                const sessionName = statusSessionNameInput.value.trim();

                if (!sessionName) {
                    alert('Por favor, informe o nome da sessão');
                    return;
                }

                // Ocultar resultados anteriores
                statusResult.style.display = 'none';
                errorStatusState.style.display = 'none';
                loadingStatusState.style.display = 'block';
                checkStatusButton.disabled = true;
                checkStatusBtn.disabled = true;

                // Fazer requisição
                fetch(`/api/message/status?sessionName=${encodeURIComponent(sessionName)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        loadingStatusState.style.display = 'none';
                        
                        if (data.success) {
                            statusResult.style.display = 'block';
                            errorStatusState.style.display = 'none';

                            const statusCard = document.getElementById('statusCard');
                            const statusIcon = document.getElementById('statusIcon');
                            const statusText = document.getElementById('statusText');
                            const statusSessionNameText = document.getElementById('statusSessionNameText');

                            const status = data.status || data.data?.result || 'UNKNOWN';
                            const isConnected = status === 'CONNECTED';

                            if (isConnected) {
                                statusCard.className = 'card mt-3 border-success';
                                statusIcon.textContent = 'check_circle';
                                statusIcon.style.color = '#28a745';
                                statusText.textContent = 'Sessão Conectada';
                                statusText.className = 'mb-0 text-success';
                            } else {
                                statusCard.className = 'card mt-3 border-warning';
                                statusIcon.textContent = 'warning';
                                statusIcon.style.color = '#ffc107';
                                statusText.textContent = `Status: ${status}`;
                                statusText.className = 'mb-0 text-warning';
                            }

                            statusSessionNameText.textContent = `Sessão: ${data.sessionName || sessionName}`;
                            document.getElementById('statusResponse').textContent = JSON.stringify(data, null, 2);
                        } else {
                            errorStatusState.style.display = 'block';
                            statusResult.style.display = 'none';
                            document.getElementById('errorStatusText').textContent = data.error || 'Erro desconhecido';
                            document.getElementById('errorStatusResponse').textContent = JSON.stringify(data, null, 2);
                        }
                    })
                    .catch(error => {
                        loadingStatusState.style.display = 'none';
                        errorStatusState.style.display = 'block';
                        statusResult.style.display = 'none';
                        document.getElementById('errorStatusText').textContent = 'Erro de conexão: ' + error.message;
                        document.getElementById('errorStatusResponse').textContent = error.stack || error.toString();
                    })
                    .finally(() => {
                        checkStatusButton.disabled = false;
                        checkStatusBtn.disabled = false;
                    });
            }

            // Event listeners para verificar status
            checkStatusButton.addEventListener('click', checkSessionStatus);
            checkStatusBtn.addEventListener('click', checkSessionStatus);

            // Verificar status ao pressionar Enter no input
            statusSessionNameInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    checkSessionStatus();
                }
            });
        });
    </script>
</x-layout>

