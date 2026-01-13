<x-layout title='Configuração do Canal de Atendimento'>
    <div class="ms-content-wrapper">
        <div class="row">
            <!-- Canais Disponíveis da API -->
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="ms-panel">
                    <div class="ms-panel-header d-flex justify-content-between">
                        <h6>Canais Disponíveis na Call 360</h6>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm" id="reloadChannelsBtn">
                                <i class="material-icons">refresh</i> Atualizar Lista
                            </button>
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        <div id="currentChannelInfo" class="alert alert-primary mb-4" style="display: none;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="material-icons">settings</i>
                                    <strong>Canal Configurado Atualmente:</strong>
                                    <span id="currentChannelName" class="ml-2 font-weight-bold"></span>
                                    <br>
                                    <small class="text-muted">ID: <code id="currentChannelValue"></code> | 
                                    Tipo: <span id="currentChannelType"></span> | 
                                    Status: <span id="currentChannelStatus"></span></small>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeChannelBtn">
                                        <i class="material-icons">delete</i> Remover
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Loading Channels -->
                        <div id="loadingChannels" class="text-center py-4" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Carregando...</span>
                            </div>
                            <p class="mt-2">Buscando canais disponíveis...</p>
                        </div>

                        <!-- Error Message -->
                        <div id="channelsError" class="alert alert-danger mt-3" style="display: none;"></div>

                        <!-- Channels List -->
                        <div id="channelsList" class="mt-3" style="display: none;">
                            <h6>Canais Disponíveis: <span id="channelsCount">0</span></h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th width="30%">Nome do Canal</th>
                                            <th width="25%">ID/Valor</th>
                                            <th width="15%">Status</th>
                                            <th width="15%">Tipo</th>
                                            <th width="15%" class="text-center">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id="channelsTableBody">
                                        <!-- Canais serão carregados aqui -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-warning mt-3" id="noChannelsMessage" style="display: none;">
                                <i class="material-icons">info</i>
                                Nenhum canal disponível na API. Verifique a conexão com o serviço.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuração do Canal -->
            <div class="col-xl-12 col-md-12">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <h6>Configuração do Canal de Atendimento</h6>
                    </div>
                    <div class="ms-panel-body">
                        <!-- Canal Atual (se existir) -->
                        

                        <!-- Formulário -->
                        <div id="channelFormContainer">
                            <form id="channelForm" method="POST">
                                @csrf
                                <input type="hidden" id="channelId" name="id" value="">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="channelName">Nome do Canal <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control" 
                                                   id="channelName" 
                                                   name="channelName" 
                                                   required
                                                   placeholder="Ex: Atendimento WhatsApp Principal">
                                            <small class="form-text text-muted">Nome amigável para identificar o canal</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="channelValue">ID do Canal <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   class="form-control bg-light" 
                                                   id="channelValue" 
                                                   name="channelValue" 
                                                   required
                                                   placeholder="Selecione um canal acima"
                                                   readonly>
                                            <small class="form-text text-muted">ID único do canal na API</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo">Tipo do Canal</label>
                                            <select class="form-control" id="tipo" name="tipo">
                                                <option value="whatsapp">WhatsApp</option>
                                                <option value="telegram">Telegram</option>
                                                <option value="messenger">Messenger</option>
                                                <option value="instagram">Instagram</option>
                                                <option value="sms">SMS</option>
                                                <option value="email">E-mail</option>
                                                <option value="outro">Outro</option>
                                            </select>
                                            <small class="form-text text-muted">Tipo de canal de atendimento</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="descricao">Descrição (Opcional)</label>
                                            <textarea class="form-control" 
                                                      id="descricao" 
                                                      name="descricao" 
                                                      rows="2"
                                                      placeholder="Adicione uma descrição sobre este canal"></textarea>
                                            <small class="form-text text-muted">Informações adicionais sobre o canal</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" checked>
                                    <label class="form-check-label" for="ativo">Canal Ativo</label>
                                    <small class="form-text text-muted d-block">Desmarque para desativar temporariamente este canal</small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary" id="saveButton">
                                            <i class="material-icons" id="saveIcon">save</i>
                                            <span id="saveText">Salvar Configuração</span>
                                        </button>
                                        <button type="button" class="btn btn-secondary" id="clearButton">
                                            <i class="material-icons">clear</i> Limpar
                                        </button>
                                    </div>
                                    
                                    <div class="text-muted">
                                        <small>Selecione um canal da tabela acima para começar</small>
                                    </div>
                                </div>
                            </form>

                            <!-- Loading State -->
                            <div id="loadingState" class="text-center py-4" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Processando...</span>
                                </div>
                                <p class="mt-2" id="loadingText">Salvando configuração...</p>
                            </div>

                            <!-- Success Message -->
                            <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                                <h6><i class="material-icons">check_circle</i> <span id="successTitle"></span></h6>
                                <p class="mb-0" id="successText"></p>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-outline-success" id="closeSuccessBtn">
                                        <i class="material-icons">close</i> Fechar
                                    </button>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="errorMessage" class="alert alert-danger mt-3" style="display: none;">
                                <h6><i class="material-icons">error</i> <span id="errorTitle"></span></h6>
                                <p class="mb-0" id="errorText"></p>
                                <div id="validationErrors" class="mt-2" style="display: none;">
                                    <ul class="mb-0" id="errorsList"></ul>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="closeErrorBtn">
                                        <i class="material-icons">close</i> Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status do Sistema -->
            <div class="col-xl-12 col-md-12 mt-4">
                <div class="ms-panel">
                    <div class="ms-panel-header">
                        <h6>Status do Sistema</h6>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">settings</i> Canal Configurado
                                        </h5>
                                        <div id="systemStatus">
                                            <div class="text-center py-3">
                                                <div class="spinner-border spinner-border-sm text-secondary" role="status">
                                                    <span class="sr-only">Carregando...</span>
                                                </div>
                                                <small class="text-muted ml-2">Verificando configuração...</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elementos principais
            const form = document.getElementById('channelForm');
            const formContainer = document.getElementById('channelFormContainer');
            const saveButton = document.getElementById('saveButton');
            const saveIcon = document.getElementById('saveIcon');
            const saveText = document.getElementById('saveText');
            const clearButton = document.getElementById('clearButton');
            const removeChannelBtn = document.getElementById('removeChannelBtn');
            const loadingState = document.getElementById('loadingState');
            const loadingText = document.getElementById('loadingText');
            const successMessage = document.getElementById('successMessage');
            const successTitle = document.getElementById('successTitle');
            const successText = document.getElementById('successText');
            const closeSuccessBtn = document.getElementById('closeSuccessBtn');
            const errorMessage = document.getElementById('errorMessage');
            const errorTitle = document.getElementById('errorTitle');
            const errorText = document.getElementById('errorText');
            const closeErrorBtn = document.getElementById('closeErrorBtn');
            
            // Elementos do formulário
            const channelIdInput = document.getElementById('channelId');
            const channelNameInput = document.getElementById('channelName');
            const channelValueInput = document.getElementById('channelValue');
            const tipoSelect = document.getElementById('tipo');
            const descricaoInput = document.getElementById('descricao');
            const ativoCheckbox = document.getElementById('ativo');
            
            // Elementos da API
            const reloadChannelsBtn = document.getElementById('reloadChannelsBtn');
            const loadingChannels = document.getElementById('loadingChannels');
            const channelsError = document.getElementById('channelsError');
            const channelsList = document.getElementById('channelsList');
            const channelsTableBody = document.getElementById('channelsTableBody');
            const channelsCount = document.getElementById('channelsCount');
            const noChannelsMessage = document.getElementById('noChannelsMessage');
            
            // Elementos de informação
            const currentChannelInfo = document.getElementById('currentChannelInfo');
            const currentChannelName = document.getElementById('currentChannelName');
            const currentChannelValue = document.getElementById('currentChannelValue');
            const currentChannelType = document.getElementById('currentChannelType');
            const currentChannelStatus = document.getElementById('currentChannelStatus');
            const systemStatusDiv = document.getElementById('systemStatus');
            const apiStatusDiv = document.getElementById('apiStatus');

            // Configuração da API
            const API_CONFIG = {
                CHANNELS_ENDPOINT: '/api/message/channels',
                SAVE_ENDPOINT: '{{ route("canal-atendimento.storeOrUpdate") }}', // Usando route helper
                CURRENT_CHANNEL_ENDPOINT: '/api/canal-atendimento/current',
                DELETE_ENDPOINT: '/api/canal-atendimento/',
                CHECK_API_STATUS: '/api/message/status'
            };

            // Estado da aplicação
            let currentChannel = null;
            let availableChannels = [];

            // DEBUG: Adicionar logs para verificar o que está acontecendo
            console.log('Configuração da API:', API_CONFIG);
            console.log('Form action should be:', API_CONFIG.SAVE_ENDPOINT);

            // Função para carregar canal atual
            async function loadCurrentChannel() {
                try {
                    console.log('Carregando canal atual...');
                    const response = await fetch(API_CONFIG.CURRENT_CHANNEL_ENDPOINT);
                    
                    if (response.status === 404) {
                        // Nenhum canal configurado
                        console.log('Nenhum canal configurado encontrado');
                        currentChannel = null;
                        updateUIForNoChannel();
                        return;
                    }
                    
                    if (!response.ok) {
                        throw new Error(`Erro HTTP ${response.status}`);
                    }
                    
                    const data = await response.json();
                    console.log('Resposta do canal atual:', data);
                    
                    if (data.success && data.data) {
                        currentChannel = data.data;
                        console.log('Canal atual carregado:', currentChannel);
                        populateForm(currentChannel);
                        updateCurrentChannelInfo(currentChannel);
                        updateUIForExistingChannel();
                    } else {
                        console.log('Resposta não contém dados válidos');
                        currentChannel = null;
                        updateUIForNoChannel();
                    }
                    
                } catch (error) {
                    console.error('Erro ao carregar canal atual:', error);
                    currentChannel = null;
                    updateUIForNoChannel();
                }
            }
            
            // Função para carregar canais da API
            async function loadApiChannels(showLoading = true) {
                try {
                    if (showLoading) {
                        loadingChannels.style.display = 'block';
                        channelsError.style.display = 'none';
                        channelsList.style.display = 'none';
                        noChannelsMessage.style.display = 'none';
                    }
                    
                    if (reloadChannelsBtn) reloadChannelsBtn.disabled = true;
                    
                    console.log('Carregando canais da API:', API_CONFIG.CHANNELS_ENDPOINT);
                    
                    const response = await fetch(API_CONFIG.CHANNELS_ENDPOINT);
                    
                    if (!response.ok) {
                        throw new Error(`Erro HTTP ${response.status}: ${response.statusText}`);
                    }
                    
                    const data = await response.json();
                    console.log('Resposta da API de canais:', data);
                    
                    // Processar resposta
                    let channels = [];
                    
                    if (Array.isArray(data)) {
                        channels = data;
                    } else if (data.success && Array.isArray(data.data)) {
                        channels = data.data;
                    } else if (data.channels && Array.isArray(data.channels)) {
                        channels = data.channels;
                    } else {
                        console.warn('Formato de resposta não reconhecido:', data);
                        throw new Error('Formato de resposta não reconhecido');
                    }
                    
                    availableChannels = channels;
                    updateChannelsTable(channels);
                    checkApiStatus();
                    
                } catch (error) {
                    console.error('Erro ao carregar canais da API:', error);
                    
                    channelsError.style.display = 'block';
                    channelsError.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="material-icons">error</i>
                            <strong>Erro ao conectar com a API</strong>
                            <p class="mb-0">${error.message}</p>
                            <small>Verifique se o serviço está disponível e tente novamente.</small>
                        </div>
                    `;
                    
                    updateApiStatusUI(false, error.message);
                    
                } finally {
                    loadingChannels.style.display = 'none';
                    if (reloadChannelsBtn) reloadChannelsBtn.disabled = false;
                }
            }
            
            // Atualizar tabela de canais
            function updateChannelsTable(channels) {
                channelsTableBody.innerHTML = '';
                
                if (channels.length === 0) {
                    channelsList.style.display = 'none';
                    noChannelsMessage.style.display = 'block';
                    channelsCount.textContent = '0';
                    return;
                }
                
                channels.forEach(channel => {
                    let channelId, channelName, channelStatus = 'desconhecido', channelType = 'whatsapp';
                    
                    if (typeof channel === 'string') {
                        channelId = channel;
                        channelName = channel;
                    } else if (typeof channel === 'object') {
                        // Ajuste para o formato da sua API
                        channelId = channel.id || channel.sessionId || channel.value || '';
                        channelName = channel.name || channel.identity?.humanId || channel.sessionName || 'Canal sem nome';
                        channelStatus = channel.active ? 'Ativo' : 'Inativo';
                        channelType = channel.type || 'whatsapp';
                    }
                    
                    if (channelId) {
                        const isCurrent = currentChannel && channelId === currentChannel.channelValue;
                        const statusBadgeClass = getStatusBadgeClass(channelStatus);
                        const typeBadgeClass = getTypeBadgeClass(channelType);
                        
                        const row = document.createElement('tr');
                        row.className = isCurrent ? 'table-primary' : '';
                        
                        row.innerHTML = `
                            <td>
                                <div class="font-weight-bold">${channelName}</div>
                                ${isCurrent ? '<small class="text-success"><i class="material-icons">check_circle</i> Configurado</small>' : ''}
                            </td>
                            <td>
                                <code class="text-muted">${channelId}</code>
                            </td>
                            <td>
                                <span class="badge badge-${statusBadgeClass}">
                                    ${channelStatus}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-${typeBadgeClass}">
                                    ${channelType}
                                </span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm ${isCurrent ? 'btn-outline-warning' : 'btn-primary'} btn-select-channel" 
                                        data-id="${channelId}" 
                                        data-name="${channelName}"
                                        data-status="${channelStatus}"
                                        data-type="${channelType}"
                                        title="${isCurrent ? 'Canal já configurado' : 'Selecionar este canal'}">
                                    <i class="material-icons">${isCurrent ? 'edit' : 'check'}</i>
                                    ${isCurrent ? 'Editar' : 'Selecionar'}
                                </button>
                            </td>
                        `;
                        channelsTableBody.appendChild(row);
                    }
                });
                
                channelsCount.textContent = channels.length;
                channelsList.style.display = 'block';
                noChannelsMessage.style.display = 'none';
            }
            
            // Helper para classe do badge de status
            function getStatusBadgeClass(status) {
                if(status){
                    return 'success';
                }else{
                    return 'secondary';
                }
            }
            
            // Helper para classe do badge de tipo
            function getTypeBadgeClass(type) {
                type = (type || '').toLowerCase();
                if (type === 'whatsapp') return 'success';
                if (type === 'telegram') return 'info';
                if (type === 'messenger') return 'primary';
                if (type === 'instagram') return 'danger';
                if (type === 'sms') return 'warning';
                if (type === 'email') return 'secondary';
                return 'dark';
            }
            
            // Preencher formulário com dados do canal
            function populateForm(channel) {
                console.log('Preenchendo formulário com:', channel);
                channelIdInput.value = channel.id || '';
                channelNameInput.value = channel.channelName || '';
                channelValueInput.value = channel.channelValue || '';
                tipoSelect.value = channel.tipo || 'whatsapp';
                descricaoInput.value = channel.descricao || '';
                ativoCheckbox.checked = channel.ativo !== false;
                
                // Habilitar botão de salvar
                saveButton.disabled = false;
            }
            
            // Atualizar informação do canal atual
            function updateCurrentChannelInfo(channel) {
                currentChannelName.textContent = channel.channelName;
                currentChannelValue.textContent = channel.channelValue;
                currentChannelType.textContent = channel.tipo || 'whatsapp';
                currentChannelStatus.textContent = channel.ativo ? 'Ativo' : 'Inativo';
                currentChannelStatus.className = channel.ativo ? 'text-success' : 'text-danger';
                currentChannelInfo.style.display = 'block';
                
                // Atualizar status do sistema
                systemStatusDiv.innerHTML = `
                    <div class="d-flex align-items-start">
                        <i class="material-icons text-success mr-2">check_circle</i>
                        <div>
                            <h6 class="mb-1">${channel.channelName}</h6>
                            <p class="mb-1 text-muted">
                                <small>ID: <code>${channel.channelValue}</code></small>
                                <br>
                                <small>Tipo: ${channel.tipo || 'whatsapp'}</small>
                                <br>
                                <small>Status: <span class="${channel.ativo ? 'text-success' : 'text-danger'}">${channel.ativo ? 'Ativo' : 'Inativo'}</span></small>
                            </p>
                            ${channel.descricao ? `<p class="mb-0"><small>${channel.descricao}</small></p>` : ''}
                        </div>
                    </div>
                `;
            }
            
            // UI quando não há canal configurado
            function updateUIForNoChannel() {
                currentChannelInfo.style.display = 'none';
                saveIcon.textContent = 'add';
                saveText.textContent = 'Cadastrar Canal';
                saveButton.disabled = true;
                
                systemStatusDiv.innerHTML = `
                    <div class="alert alert-warning">
                        <i class="material-icons">warning</i>
                        <span>Nenhum canal configurado. Selecione um canal da tabela acima para começar.</span>
                    </div>
                `;
            }
            
            // UI quando já existe canal
            function updateUIForExistingChannel() {
                saveIcon.textContent = 'save';
                saveText.textContent = 'Atualizar Configuração';
                saveButton.disabled = false;
            }
            
            // Verificar status da API
            async function checkApiStatus() {
                try {
                    if (!currentChannel || !currentChannel.channelValue) {
                        apiStatusDiv.innerHTML = `
                            <div class="alert alert-warning">
                                <i class="material-icons">info</i>
                                <span>Configure um canal para verificar o status da API</span>
                            </div>
                        `;
                        return;
                    }
                    
                    const response = await fetch(`${API_CONFIG.CHECK_API_STATUS}?sessionName=${encodeURIComponent(currentChannel.channelValue)}`);
                    
                    if (!response.ok) {
                        updateApiStatusUI(false, `Erro HTTP ${response.status}`);
                        return;
                    }
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        const status = data.status || data.data?.result || 'UNKNOWN';
                        const isConnected = status === 'CONNECTED' || status === 'connected' || status === 'AUTHENTICATED';
                        
                        updateApiStatusUI(isConnected, status);
                    } else {
                        updateApiStatusUI(false, data.error || 'Erro desconhecido');
                    }
                    
                } catch (error) {
                    console.error('Erro ao verificar status da API:', error);
                    updateApiStatusUI(false, error.message);
                }
            }
            
            // Atualizar UI do status da API
            function updateApiStatusUI(isConnected, message) {
                if (isConnected) {
                    apiStatusDiv.innerHTML = `
                        <div class="alert alert-success">
                            <div class="d-flex align-items-center">
                                <i class="material-icons text-success mr-2">check_circle</i>
                                <div>
                                    <strong class="mb-0">Conectado</strong>
                                    <p class="mb-0 text-muted"><small>Status: ${message}</small></p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    apiStatusDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center">
                                <i class="material-icons text-danger mr-2">error</i>
                                <div>
                                    <strong class="mb-0">Desconectado</strong>
                                    <p class="mb-0 text-muted"><small>${message}</small></p>
                                </div>
                            </div>
                        </div>
                    `;
                }
            }
            
            // Inicialização
            loadCurrentChannel();
            loadApiChannels();
            
            // Event Listeners
            
            // Recarregar canais
            reloadChannelsBtn.addEventListener('click', () => {
                loadApiChannels(true);
                checkApiStatus();
            });
            
            // Selecionar canal da tabela
            document.addEventListener('click', function(e) {
                if (e.target.closest('.btn-select-channel')) {
                    const button = e.target.closest('.btn-select-channel');
                    const channelId = button.getAttribute('data-id');
                    const channelName = button.getAttribute('data-name');
                    const channelStatus = button.getAttribute('data-status');
                    const channelType = button.getAttribute('data-type');
                    
                    console.log('Canal selecionado:', { channelId, channelName, channelStatus, channelType });
                    
                    // Preencher formulário
                    channelValueInput.value = channelId;
                    channelNameInput.value = channelName;
                    tipoSelect.value = channelType || 'whatsapp';
                    
                    // Se já existe um canal, manter o ID para atualização
                    if (currentChannel) {
                        channelIdInput.value = currentChannel.id;
                    }
                    
                    // Habilitar botão de salvar
                    saveButton.disabled = false;
                    
                    // Scroll para o formulário
                    formContainer.scrollIntoView({ behavior: 'smooth' });
                    channelNameInput.focus();
                    
                    // Feedback visual
                    showToast(`Canal "${channelName}" selecionado!`);
                }
            });
            
            // Enviar formulário - CORREÇÃO PRINCIPAL
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                console.log('Formulário submetido');
                console.log('Dados do formulário:', {
                    channelName: channelNameInput.value,
                    channelValue: channelValueInput.value,
                    tipo: tipoSelect.value,
                    descricao: descricaoInput.value,
                    ativo: ativoCheckbox.checked
                });
                
                // Validação
                if (!channelNameInput.value.trim()) {
                    alert('Por favor, informe o nome do canal');
                    channelNameInput.focus();
                    return;
                }
                
                if (!channelValueInput.value.trim()) {
                    alert('Por favor, selecione um canal da tabela acima');
                    return;
                }
                
                // Configurar loading
                loadingState.style.display = 'block';
                loadingText.textContent = currentChannel ? 'Atualizando configuração...' : 'Cadastrando canal...';
                saveButton.disabled = true;
                clearButton.disabled = true;
                
                // Ocultar mensagens
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                
                // Enviar dados
                try {
                    console.log('Enviando para:', API_CONFIG.SAVE_ENDPOINT);
                    
                    // Criar objeto FormData
                    const formData = new FormData();
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
                    formData.append('id', channelIdInput.value);
                    formData.append('channelName', channelNameInput.value);
                    formData.append('channelValue', channelValueInput.value);
                    formData.append('tipo', tipoSelect.value);
                    formData.append('descricao', descricaoInput.value);
                    formData.append('ativo', ativoCheckbox.checked ? '1' : '0');
                    
                    const response = await fetch(API_CONFIG.SAVE_ENDPOINT, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    });
                    
                    console.log('Resposta recebida:', response.status, response.statusText);
                    
                    const data = await response.json();
                    console.log('Dados da resposta:', data);
                    
                    if (response.ok && data.success) {
                        // Sucesso
                        successTitle.textContent = currentChannel ? 'Configuração Atualizada!' : 'Canal Cadastrado!';
                        successText.textContent = data.message || (currentChannel ? 'Configuração atualizada com sucesso!' : 'Canal cadastrado com sucesso!');
                        successMessage.style.display = 'block';
                        
                        // Recarregar dados
                        await loadCurrentChannel();
                        await loadApiChannels(false);
                        
                    } else {
                        // Erro
                        errorTitle.textContent = 'Erro ao Salvar';
                        errorText.textContent = data.message || 'Ocorreu um erro ao salvar a configuração';
                        errorMessage.style.display = 'block';
                        
                        // Mostrar erros de validação
                        if (data.errors) {
                            const errorsList = document.getElementById('errorsList');
                            errorsList.innerHTML = '';
                            
                            for (const [field, messages] of Object.entries(data.errors)) {
                                messages.forEach(message => {
                                    const li = document.createElement('li');
                                    li.textContent = `${field}: ${message}`;
                                    errorsList.appendChild(li);
                                });
                            }
                            
                            document.getElementById('validationErrors').style.display = 'block';
                        }
                    }
                    
                } catch (error) {
                    console.error('Erro no envio do formulário:', error);
                    errorTitle.textContent = 'Erro de Conexão';
                    errorText.textContent = 'Erro de conexão: ' + error.message;
                    errorMessage.style.display = 'block';
                } finally {
                    loadingState.style.display = 'none';
                    saveButton.disabled = false;
                    clearButton.disabled = false;
                }
            });
            
            // Limpar formulário
            clearButton.addEventListener('click', function() {
                if (currentChannel) {
                    // Se tem canal atual, restaurar valores
                    populateForm(currentChannel);
                } else {
                    // Se não tem canal, limpar tudo
                    form.reset();
                    saveButton.disabled = true;
                }
                
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                document.getElementById('validationErrors').style.display = 'none';
                
                showToast('Formulário limpo');
            });
            
            // Remover canal
            removeChannelBtn.addEventListener('click', async function() {
                if (!currentChannel || !confirm('Tem certeza que deseja remover o canal configurado?')) {
                    return;
                }
                
                try {
                    const response = await fetch(`${API_CONFIG.DELETE_ENDPOINT}${currentChannel.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (response.ok && data.success) {
                        showToast('Canal removido com sucesso!');
                        currentChannel = null;
                        form.reset();
                        await loadCurrentChannel();
                        await loadApiChannels(false);
                    } else {
                        showToast('Erro ao remover canal: ' + (data.message || 'Erro desconhecido'), 'error');
                    }
                    
                } catch (error) {
                    showToast('Erro de conexão: ' + error.message, 'error');
                }
            });
            
            // Fechar mensagens
            closeSuccessBtn.addEventListener('click', function() {
                successMessage.style.display = 'none';
            });
            
            closeErrorBtn.addEventListener('click', function() {
                errorMessage.style.display = 'none';
            });
            
            // Função para mostrar toast/feedback
            function showToast(message, type = 'success') {
                // Criar elemento toast
                const toast = document.createElement('div');
                toast.className = `toast-alert alert alert-${type === 'error' ? 'danger' : 'success'} fade show`;
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 250px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                `;
                toast.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="material-icons mr-2">${type === 'error' ? 'error' : 'check_circle'}</i>
                        <span>${message}</span>
                    </div>
                `;
                
                document.body.appendChild(toast);
                
                // Remover após 3 segundos
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => {
                        if (toast.parentNode) {
                            document.body.removeChild(toast);
                        }
                    }, 300);
                }, 3000);
            }
        });
    </script>
    
    <style>
        .toast-alert {
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .btn-select-channel {
            transition: all 0.2s;
        }
        
        .btn-select-channel:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05);
        }
        
        .table-primary {
            background-color: rgba(0,123,255,0.1) !important;
        }
    </style>
</x-layout>