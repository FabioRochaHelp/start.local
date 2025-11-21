<x-layout title='Atendimento - Pacientes'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Atendimento </li>
                        <li class="breadcrumb-item active" aria-current="page">Pacientes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Buscar Pacientes</h6>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            <!-- Buscar por Nome -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">person</i> Buscar por Nome
                                        </h5>
                                        <form action="{{ route('ateatend.search.nome') }}" method="GET">
                                            <div class="form-group">
                                                <label for="nome">Nome do Paciente</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="nome" 
                                                       name="nome" 
                                                       placeholder="Digite o nome do paciente"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Documento -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">badge</i> Buscar por Documento
                                        </h5>
                                        <form action="{{ route('ateatend.search.documento') }}" method="GET">
                                            <div class="form-group">
                                                <label for="documento">CPF/CNPJ</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="documento" 
                                                       name="documento" 
                                                       placeholder="Digite o documento"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por ID -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">tag</i> Buscar por ID
                                        </h5>
                                        <form action="{{ route('ateatend.search.id') }}" method="GET">
                                            <div class="form-group">
                                                <label for="id_search">ID do Paciente</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="id_search" 
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

                            <!-- Listar Todos -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">list</i> Listar Todos os Pacientes
                                        </h5>
                                        <p class="card-text">Visualize todos os pacientes cadastrados com paginação.</p>
                                        <a href="{{ route('ateatend.list') }}" class="btn btn-primary">
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
</x-layout>

