<x-layout title='Health Check - Status do Sistema'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header d-flex justify-content-between">
                        <h6>Health Check - Status da Aplicação e Conexão com Banco</h6>
                        <button type="button" class="btn btn-primary btn-sm" id="refreshHealthCheck">
                            <i class="material-icons">refresh</i> Atualizar
                        </button>
                    </div>
                    <div class="ms-panel-body">
                        <!-- Loading State -->
                        <div id="loadingState" class="text-center py-5" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Carregando...</span>
                            </div>
                            <p class="mt-3">Verificando status do sistema...</p>
                        </div>

                        <!-- Health Check Results -->
                        <div id="healthCheckResults" style="display: none;">
                            <!-- Status Geral -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card" id="statusCard">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <i class="material-icons" id="statusIcon" style="font-size: 48px;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Status Geral</h5>
                                                    <p class="mb-0" id="statusText"></p>
                                                    <small class="text-muted" id="timestampText"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status do Banco de Dados -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Status da Conexão com Oracle</h6>
                                        </div>
                                        <div class="card-body">
                                            <div id="databaseStatus">
                                                <!-- Database status will be inserted here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detalhes JSON -->
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Resposta Completa da API</h6>
                                        </div>
                                        <div class="card-body">
                                            <pre id="jsonResponse" class="bg-light p-3 rounded" style="max-height: 400px; overflow-y: auto;"></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Error State -->
                        <div id="errorState" class="alert alert-danger" style="display: none;">
                            <h6><i class="material-icons">error</i> Erro ao verificar status</h6>
                            <p id="errorMessage"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const refreshButton = document.getElementById('refreshHealthCheck');
            const loadingState = document.getElementById('loadingState');
            const healthCheckResults = document.getElementById('healthCheckResults');
            const errorState = document.getElementById('errorState');

            // Função para fazer requisição ao health check
            function checkHealth() {
                // Mostrar loading
                loadingState.style.display = 'block';
                healthCheckResults.style.display = 'none';
                errorState.style.display = 'none';

                // Fazer requisição à API
                fetch('/api/health')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        displayHealthResults(data);
                    })
                    .catch(error => {
                        displayError(error.message);
                    })
                    .finally(() => {
                        loadingState.style.display = 'none';
                    });
            }

            // Função para exibir os resultados
            function displayHealthResults(data) {
                healthCheckResults.style.display = 'block';
                errorState.style.display = 'none';

                // Status Geral
                const statusCard = document.getElementById('statusCard');
                const statusIcon = document.getElementById('statusIcon');
                const statusText = document.getElementById('statusText');
                const timestampText = document.getElementById('timestampText');

                if (data.status === 'healthy') {
                    statusCard.className = 'card border-success';
                    statusIcon.textContent = 'check_circle';
                    statusIcon.style.color = '#28a745';
                    statusText.textContent = 'Sistema Operacional';
                    statusText.className = 'mb-0 text-success';
                } else {
                    statusCard.className = 'card border-danger';
                    statusIcon.textContent = 'error';
                    statusIcon.style.color = '#dc3545';
                    statusText.textContent = 'Sistema com Problemas';
                    statusText.className = 'mb-0 text-danger';
                }

                timestampText.textContent = `Última verificação: ${new Date(data.timestamp).toLocaleString('pt-BR')}`;

                // Status do Banco de Dados
                const databaseStatus = document.getElementById('databaseStatus');
                const db = data.database || {};

                let dbHtml = `
                    <div class="d-flex align-items-center mb-3">
                        <i class="material-icons mr-2" style="font-size: 32px; color: ${db.connected ? '#28a745' : '#dc3545'};">
                            ${db.connected ? 'check_circle' : 'cancel'}
                        </i>
                        <div>
                            <h6 class="mb-1">${db.connected ? 'Conectado' : 'Desconectado'}</h6>
                            <p class="mb-0 text-muted">${db.message || 'N/A'}</p>
                        </div>
                    </div>
                `;

                if (db.details) {
                    dbHtml += `
                        <div class="mt-3">
                            <h6>Detalhes:</h6>
                            <ul class="list-unstyled">
                                <li><strong>Status do Pool:</strong> <span class="badge badge-${db.details.poolStatus === 'active' ? 'success' : 'danger'}">${db.details.poolStatus || 'N/A'}</span></li>
                                ${db.details.testQuery ? `<li><strong>Query de Teste:</strong> ${JSON.stringify(db.details.testQuery)}</li>` : ''}
                                ${db.details.error ? `<li class="text-danger"><strong>Erro:</strong> ${db.details.error}</li>` : ''}
                            </ul>
                        </div>
                    `;
                }

                databaseStatus.innerHTML = dbHtml;

                // JSON Response
                document.getElementById('jsonResponse').textContent = JSON.stringify(data, null, 2);
            }

            // Função para exibir erro
            function displayError(message) {
                errorState.style.display = 'block';
                healthCheckResults.style.display = 'none';
                document.getElementById('errorMessage').textContent = message;
            }

            // Event listeners
            refreshButton.addEventListener('click', checkHealth);

            // Verificar automaticamente ao carregar a página
            checkHealth();

            // Auto-refresh a cada 30 segundos (opcional)
            // setInterval(checkHealth, 30000);
        });
    </script>
</x-layout>

