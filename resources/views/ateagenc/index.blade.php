<x-layout title='Agendamentos - ATEAGENC'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Agendamentos </li>
                        <li class="breadcrumb-item active" aria-current="page">ATEAGENC</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Gerenciar Agendamentos</h6>
                        <a href="{{ route('ateagenc.create') }}" class="ms-text-primary">Adicionar Agendamento</a>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            <!-- Buscar por ID -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">tag</i> Buscar por ID
                                        </h5>
                                        <p class="card-text text-muted">Busca detalhes completos do agendamento por ID</p>
                                        <form action="{{ route('ateagenc.search.id') }}" method="GET">
                                            <div class="form-group">
                                                <label for="id">ID do Agendamento</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="id" 
                                                       name="id" 
                                                       placeholder="Digite o ID"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Nome da Consulta -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">search</i> Buscar por Nome da Consulta
                                        </h5>
                                        <p class="card-text text-muted">Busca agendamentos pelo nome da consulta</p>
                                        <form action="{{ route('ateagenc.search.nome.consulta') }}" method="GET">
                                            <div class="form-group">
                                                <label for="nome_consulta">Nome da Consulta</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="nome_consulta" 
                                                       name="nome" 
                                                       placeholder="Digite o nome"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Listar Todos -->
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">list</i> Listar Todos os Agendamentos
                                        </h5>
                                        <p class="card-text">Visualize todos os agendamentos cadastrados com paginação.</p>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="completo_list" 
                                                   name="completo" 
                                                   value="1">
                                            <label class="form-check-label" for="completo_list">
                                                Listar com dados completos (JOINs)
                                            </label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" 
                                                   class="form-check-input" 
                                                   id="detalhes_list" 
                                                   name="detalhes" 
                                                   value="1">
                                            <label class="form-check-label" for="detalhes_list">
                                                Listar com detalhes estruturados (dados separados por entidade)
                                            </label>
                                        </div>
                                        <a href="{{ route('ateagenc.list') }}" class="btn btn-primary" id="btnListar">
                                            <i class="material-icons">list</i> Ver Lista Completa
                                        </a>
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
            const btnListar = document.getElementById('btnListar');
            const completoList = document.getElementById('completo_list');
            const detalhesList = document.getElementById('detalhes_list');
            
            if (btnListar) {
                btnListar.addEventListener('click', function(e) {
                    const params = new URLSearchParams();
                    
                    if (completoList && completoList.checked) {
                        params.append('completo', '1');
                    }
                    
                    if (detalhesList && detalhesList.checked) {
                        params.append('detalhes', '1');
                    }
                    
                    if (params.toString()) {
                        e.preventDefault();
                        window.location.href = '{{ route('ateagenc.list') }}?' + params.toString();
                    }
                });
            }
        });
    </script>
</x-layout>
