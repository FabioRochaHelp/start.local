<x-layout title='Envio de Mensagens'>
    <div class="ms-content-wrapper">
        <div class="row">
            <!-- Verificar Status da Sessão -->
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="ms-panel">
                    <div class="ms-panel-header d-flex justify-content-between">
                        <h6>Verificar Status da Sessão</h6>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm" id="reloadChannelsBtn">
                                <i class="material-icons">refresh</i> Recarregar Canais
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div class="form-group">
                            <label for="statusSessionName">Canais de Atendimento</label>
                            <div class="input-group">
                                <select class="form-control" id="statusSessionName" name="statusSessionName">
                                    <option value="">Carregando canais...</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="refreshChannelsBtn" title="Recarregar canais">
                                        <i class="material-icons">refresh</i>
                                    </button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Selecione um canal de atendimento WhatsApp</small>
                            <div id="channelsError" class="text-danger mt-1" style="display: none;"></div>
                        </div>

                        <!-- Alternative: Manual Session Input -->
                        <div class="form-group mt-3" id="manualSessionGroup" style="display: none;">
                            <label for="manualSessionName">Ou digite o nome da sessão manualmente</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="manualSessionName" 
                                   name="manualSessionName"
                                   placeholder="Ex: session1, atendimento, whatsapp1">
                            <small class="form-text text-muted">Digite o nome exato da sessão do WhatsApp</small>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="useManualSession">
                            <label class="form-check-label" for="useManualSession">Usar nome de sessão manual</label>
                        </div>

                        <!-- Loading State Status -->
                        <div id="loadingStatusState" class="text-center py-3" style="display: none;">
                            <div class="spinner-border text-info" role="status">
                                <span class="sr-only">Verificando...</span>
                            </div>
                            <p class="mt-2">Verificando status da sessão...</p>
                        </div>

                        <!-- Loading Channels -->
                        <div id="loadingChannels" class="text-center py-2" style="display: none;">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="sr-only">Carregando...</span>
                            </div>
                            <small class="text-muted ml-2">Carregando canais...</small>
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
                                <select class="form-control" 
                                       id="sessionName" 
                                       name="sessionName" 
                                       required>
                                    <option value="">Carregando canais...</option>
                                </select>
                                <small class="form-text text-muted">Selecione uma sessão WhatsApp</small>
                            </div>

                            <div class="form-group">
                                <label for="number">Número do Destinatário <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control" 
                                       id="number" 
                                       name="number" 
                                       required
                                       placeholder="Ex: 556334140378 (com código do país, sem espaços ou caracteres especiais)">
                                <small class="form-text text-muted">Apenas dígitos, incluindo código do país. Ex: 5511999999999</small>
                            </div>

                            <div class="form-group">
                                <label for="text">Mensagem <span class="text-danger">*</span></label>
                                <textarea class="form-control" 
                                          id="text" 
                                          name="text" 
                                          rows="5" 
                                          required
                                          placeholder="Digite sua mensagem aqui..."></textarea>
                                <small class="form-text text-muted">Suporta quebras de linha</small>
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
            
            // Elementos dos selects
            const statusSessionNameSelect = document.getElementById('statusSessionName');
            const sessionNameSelect = document.getElementById('sessionName');
            const reloadChannelsBtn = document.getElementById('reloadChannelsBtn');
            const refreshChannelsBtn = document.getElementById('refreshChannelsBtn');
            const loadingChannels = document.getElementById('loadingChannels');
            const channelsError = document.getElementById('channelsError');
            
            // Elementos para sessão manual
            const manualSessionGroup = document.getElementById('manualSessionGroup');
            const useManualSessionCheckbox = document.getElementById('useManualSession');
            const manualSessionNameInput = document.getElementById('manualSessionName');

            // Variáveis de configuração
            const API_CONFIG = {
                CHANNELS_ENDPOINT: '/api/message/channels', // Proxy local que você precisa criar
                SEND_ENDPOINT: '/api/message/send',
                STATUS_ENDPOINT: '/api/message/status'
            };

            // Dados mock para teste (remova em produção)
            const MOCK_CHANNELS = [
                "session1",
                "whatsapp-01", 
                "atendimento",
                "vendas",
                "suporte"
            ];

            // Função para carregar os canais (sessões)
            async function loadChannels(showLoading = true) {
                try {
                    if (showLoading) {
                        loadingChannels.style.display = 'block';
                        channelsError.style.display = 'none';
                    }
                    
                    // Desabilitar botões durante o carregamento
                    if (reloadChannelsBtn) reloadChannelsBtn.disabled = true;
                    if (refreshChannelsBtn) refreshChannelsBtn.disabled = true;
                    
                    // Verificar se o endpoint está configurado
                    if (!API_CONFIG.CHANNELS_ENDPOINT) {
                        console.warn('Endpoint de canais não configurado. Usando modo manual.');
                        useManualSessionCheckbox.checked = true;
                        toggleManualSessionInput();
                        processChannels([]); // Processa array vazio
                        return;
                    }
                    
                    console.log('Carregando canais de:', API_CONFIG.CHANNELS_ENDPOINT);
                    
                    // Usar timeout para evitar requisições muito longas
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 8000); // 8 segundos
                    
                    const response = await fetch(API_CONFIG.CHANNELS_ENDPOINT, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                            // NÃO adicione headers CORS aqui - eles não funcionam do lado do cliente
                        },
                        signal: controller.signal,
                        mode: 'cors' // Isso é padrão, mas pode ser omitido
                    }).catch(error => {
                        if (error.name === 'AbortError') {
                            throw new Error('Tempo limite excedido ao carregar canais');
                        }
                        throw error;
                    });

             
                    
                    clearTimeout(timeoutId);
                    
                    // Verificar status da resposta
                    if (!response.ok) {
                        const errorText = await response.text().catch(() => 'Sem detalhes');
                        throw new Error(`Erro HTTP ${response.status}: ${response.statusText}. Detalhes: ${errorText.substring(0, 100)}`);
                    }
                    
                    // Verificar se a resposta é JSON
                    const contentType = response.headers.get('content-type');

                    console.log('Resposta de canais:', response.status, contentType);
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.warn('Resposta não é JSON:', text.substring(0, 200));
                        
                        // Se for texto simples com canais (um por linha)
                        if (text.includes('\n') || text.includes(',')) {
                            // Tentar extrair canais de texto simples
                            const lines = text.split('\n').filter(line => line.trim());
                            const items = lines.map(line => line.trim());
                            if (items.length > 0) {
                                console.log('Extraído', items.length, 'canais de texto simples');
                                processChannels(items);
                                return;
                            }
                        }
                        
                        throw new Error(`Formato de resposta não suportado: ${contentType}`);
                    }
                    
                    const data = await response.json();
                    
                    // Processar resposta baseado em diferentes formatos possíveis
                    let channels = [];
                    
                    if (Array.isArray(data)) {
                        // Caso 1: Resposta é um array direto
                        channels = data;
                    } else if (data.success && Array.isArray(data.data)) {
                        // Caso 2: Resposta com estrutura {success: true, data: []}
                        channels = data.data;
                    } else if (data.channels && Array.isArray(data.channels)) {
                        // Caso 3: Resposta com estrutura {channels: []}
                        channels = data.channels;
                    } else if (data.sessions && Array.isArray(data.sessions)) {
                        // Caso 4: Resposta com estrutura {sessions: []}
                        channels = data.sessions;
                    } else if (data.message) {
                        // Caso 5: Resposta com mensagem de erro
                        throw new Error(data.message);
                    } else {
                        console.warn('Formato de resposta inesperado:', data);
                        // Tentar usar dados mock se a resposta não for reconhecida
                        if (process.env.NODE_ENV === 'development') {
                            console.log('Usando dados mock para desenvolvimento');
                            channels = MOCK_CHANNELS;
                        } else {
                            throw new Error('Formato de resposta da API não reconhecido');
                        }
                    }
                    
                    // Processar canais
                    processChannels(channels);
                    
                } catch (error) {
                    console.error('Erro ao carregar canais:', error);
                    
                    // Mostrar erro amigável para o usuário
                    channelsError.style.display = 'block';
                    channelsError.innerHTML = `
                       
                        <div class="alert alert-danger mt-3" role="alert">
                            <i class="flaticon-danger"></i>
                            <span class="ms-alert-message">Erro ao carregar canais de atendimento. Verifique se o serviço Call 360 esta disponível</span>
                        </div>
                    `;
                    
                    // Definir opções de erro nos selects
                    setSelectNoChannels(statusSessionNameSelect, "Erro ao carregar");
                    setSelectNoChannels(sessionNameSelect, "Erro ao carregar");
                    
                    // Sugerir usar sessão manual
                    useManualSessionCheckbox.checked = true;
                    toggleManualSessionInput();
                    
                    // Usar dados mock em desenvolvimento
                    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                        console.log('Modo desenvolvimento: usando canais mock');
                        processChannels(MOCK_CHANNELS);
                    }
                    
                } finally {
                    loadingChannels.style.display = 'none';
                    if (reloadChannelsBtn) reloadChannelsBtn.disabled = false;
                    if (refreshChannelsBtn) refreshChannelsBtn.disabled = false;
                }
            }
            
            // Processar lista de canais
            function processChannels(channels) {
                // Limpar opções atuais
                clearSelectOptions(statusSessionNameSelect);
                clearSelectOptions(sessionNameSelect);
                
                // Adicionar opção padrão
                const defaultOption1 = document.createElement('option');
                defaultOption1.value = "";
                defaultOption1.textContent = channels.length > 0 ? "Selecione um canal" : "Nenhum canal disponível";
                if (channels.length === 0) defaultOption1.disabled = true;
                statusSessionNameSelect.appendChild(defaultOption1);
                
                const defaultOption2 = document.createElement('option');
                defaultOption2.value = "";
                defaultOption2.textContent = channels.length > 0 ? "Selecione um canal" : "Nenhum canal disponível";
                if (channels.length === 0) defaultOption2.disabled = true;
                sessionNameSelect.appendChild(defaultOption2);
                
                // Adicionar as sessões como opções
                if (channels.length > 0) {
                    channels.forEach(channel => {
                        // Extrair nome e valor do canal
                        let channelName, channelValue;
                        
                        channelValue = channel.id;
                        channelName = channel.identity.humanId;
                        
                        // Para o select de status
                        const option1 = document.createElement('option');
                        option1.value = channelValue;
                        option1.textContent = channelName;
                        statusSessionNameSelect.appendChild(option1);
                        
                        // Para o select do formulário
                        const option2 = document.createElement('option');
                        option2.value = channelValue;
                        option2.textContent = channelName;
                        sessionNameSelect.appendChild(option2);
                    });
                    
                    // Selecionar primeiro canal se disponível
                    if (channels[0]) {
                        let firstValue;
                        if (typeof channels[0] === 'string') {
                            firstValue = channels[0];
                        } else if (typeof channels[0] === 'object') {
                            firstValue = channels[0].id || channels[0].name || channels[0].sessionName;
                        }
                        
                        if (firstValue) {
                            statusSessionNameSelect.value = firstValue;
                            sessionNameSelect.value = firstValue;
                        }
                    }
                    
                    console.log(`Canais carregados: ${channels.length} encontrados`);
                    
                } else {
                    // Nenhum canal disponível
              
                    console.log('Nenhum canal encontrado');
                }
            }
            
            // Função auxiliar para limpar options do select
            function clearSelectOptions(selectElement) {
                while (selectElement.options.length > 0) {
                    selectElement.remove(0);
                }
            }
            
            // Função auxiliar para definir mensagem de "sem canais"
            function setSelectNoChannels(selectElement, message) {
                clearSelectOptions(selectElement);
                const option = document.createElement('option');
                option.value = "";
                option.textContent = message;
                option.disabled = true;
                selectElement.appendChild(option);
            }
            
            // Alternar entre select e input manual
            function toggleManualSessionInput() {
                if (useManualSessionCheckbox.checked) {
                    manualSessionGroup.style.display = 'block';
                    statusSessionNameSelect.disabled = true;
                    sessionNameSelect.disabled = true;
                    
                    // Copiar valor do select para o input se houver
                    if (statusSessionNameSelect.value && statusSessionNameSelect.value !== "") {
                        manualSessionNameInput.value = statusSessionNameSelect.value;
                    }
                } else {
                    manualSessionGroup.style.display = 'none';
                    statusSessionNameSelect.disabled = false;
                    sessionNameSelect.disabled = false;
                    
                    // Copiar valor do input para o select se houver
                    if (manualSessionNameInput.value.trim() !== "") {
                        statusSessionNameSelect.value = manualSessionNameInput.value;
                        sessionNameSelect.value = manualSessionNameInput.value;
                    }
                }
            }

            // Carregar canais ao iniciar a página
            // Só carrega se não estiver em modo manual por padrão
            if (!useManualSessionCheckbox.checked) {
                loadChannels();
            } else {
                // Se já estiver em modo manual, processa array vazio
                processChannels([]);
            }

            // Event listeners para botões de recarregar canais
            if (reloadChannelsBtn) {
                reloadChannelsBtn.addEventListener('click', () => loadChannels(true));
            }
            
            if (refreshChannelsBtn) {
                refreshChannelsBtn.addEventListener('click', () => loadChannels(true));
            }
            
            // Alternar entrada manual de sessão
            useManualSessionCheckbox.addEventListener('change', toggleManualSessionInput);
            
            // Atualizar selects quando input manual mudar
            manualSessionNameInput.addEventListener('input', function() {
                if (useManualSessionCheckbox.checked) {
                    statusSessionNameSelect.value = this.value;
                    sessionNameSelect.value = this.value;
                }
            });

            // Função para obter o nome da sessão atual
            function getCurrentSessionName() {
                if (useManualSessionCheckbox.checked && manualSessionNameInput.value.trim() !== "") {
                    return manualSessionNameInput.value.trim();
                } else {
                    return statusSessionNameSelect.value;
                }
            }

            // Enviar formulário
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const sessionName = getCurrentSessionName();
                const number = document.getElementById('number').value.replace(/\D/g, ''); // Remove não-dígitos
                const text = document.getElementById('text').value.trim();
                
                // Validação
                if (!sessionName) {
                    alert('Por favor, selecione ou digite o nome da sessão');
                    return;
                }
                
                if (!number) {
                    alert('Por favor, informe o número do destinatário');
                    return;
                }
                
                if (!/^\d{10,15}$/.test(number)) {
                    alert('Número inválido. Use apenas dígitos (10-15 caracteres). Ex: 5511999999999');
                    return;
                }
                
                if (!text) {
                    alert('Por favor, digite a mensagem');
                    return;
                }

                // Ocultar mensagens anteriores
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                loadingState.style.display = 'block';
                sendButton.disabled = true;

                // Coletar dados do formulário
                const formData = {
                    sessionName: sessionName,
                    number: number,
                    text: text
                };

                try {
                    console.log('Enviando mensagem para:', API_CONFIG.SEND_ENDPOINT, formData);
                    
                    const response = await fetch(API_CONFIG.SEND_ENDPOINT, {
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
                        
                        // Limpar campo de mensagem após sucesso
                        document.getElementById('text').value = '';
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
                document.getElementById('number').value = '';
                document.getElementById('text').value = '';
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
            });

            // Verificar Status da Sessão
            const checkStatusButton = document.getElementById('checkStatusButton');
            const loadingStatusState = document.getElementById('loadingStatusState');
            const statusResult = document.getElementById('statusResult');
            const errorStatusState = document.getElementById('errorStatusState');

            async function checkSessionStatus() {
                const sessionName = getCurrentSessionName();

                if (!sessionName) {
                    alert('Por favor, selecione ou digite o nome da sessão');
                    return;
                }

                // Ocultar resultados anteriores
                statusResult.style.display = 'none';
                errorStatusState.style.display = 'none';
                loadingStatusState.style.display = 'block';
                checkStatusButton.disabled = true;

                try {
                    console.log('Verificando status para sessão:', sessionName);
                    
                    const response = await fetch(`${API_CONFIG.STATUS_ENDPOINT}?sessionName=${encodeURIComponent(sessionName)}`);
                    
                    if (!response.ok) {
                        throw new Error(`Erro HTTP ${response.status}`);
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        statusResult.style.display = 'block';
                        errorStatusState.style.display = 'none';

                        const statusCard = document.getElementById('statusCard');
                        const statusIcon = document.getElementById('statusIcon');
                        const statusText = document.getElementById('statusText');
                        const statusSessionNameText = document.getElementById('statusSessionNameText');

                        const status = data.status || data.data?.result || data.data?.state || 'UNKNOWN';
                        const isConnected = status === 'CONNECTED' || status === 'connected' || status === 'AUTHENTICATED';

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
                } catch (error) {
                    loadingStatusState.style.display = 'none';
                    errorStatusState.style.display = 'block';
                    statusResult.style.display = 'none';
                    document.getElementById('errorStatusText').textContent = 'Erro de conexão: ' + error.message;
                    document.getElementById('errorStatusResponse').textContent = error.stack || error.toString();
                } finally {
                    checkStatusButton.disabled = false;
                }
            }

            // Event listener para verificar status
            checkStatusButton.addEventListener('click', checkSessionStatus);

            // Sincronizar selects - quando mudar um, muda o outro
            statusSessionNameSelect.addEventListener('change', function() {
                if (!useManualSessionCheckbox.checked) {
                    sessionNameSelect.value = this.value;
                }
            });

            sessionNameSelect.addEventListener('change', function() {
                if (!useManualSessionCheckbox.checked) {
                    statusSessionNameSelect.value = this.value;
                }
            });
            
            // Configuração inicial
            toggleManualSessionInput();
        });
    </script>
</x-layout>