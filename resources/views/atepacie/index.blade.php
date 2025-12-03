<x-layout title='Pacientes - ATEPACIE'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Pacientes </li>
                        <li class="breadcrumb-item active" aria-current="page">ATEPACIE</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Gerenciar Pacientes</h6>
                        <a href="{{ route('atepacie.create') }}" class="ms-text-primary">Adicionar Paciente</a>
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
                                        <form action="{{ route('atepacie.search.nome') }}" method="GET">
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

                            <!-- Buscar por CPF -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">badge</i> Buscar por CPF
                                        </h5>
                                        <form action="{{ route('atepacie.search.cpf') }}" method="GET">
                                            <div class="form-group">
                                                <label for="cpf">CPF</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="cpf" 
                                                       name="cpf" 
                                                       placeholder="Digite o CPF"
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
                                            <i class="material-icons">description</i> Buscar por Documento
                                        </h5>
                                        <form action="{{ route('atepacie.search.documento') }}" method="GET">
                                            <div class="form-group">
                                                <label for="documento">Documento</label>
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

                            <!-- Buscar por Número -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">tag</i> Buscar por Número
                                        </h5>
                                        <form action="{{ route('atepacie.search.numero') }}" method="GET">
                                            <div class="form-group">
                                                <label for="numero">Número do Paciente (NNUMEPACIE)</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="numero" 
                                                       name="numero" 
                                                       placeholder="Digite o número"
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
                                            <i class="material-icons">list</i> Listar Todos os Pacientes
                                        </h5>
                                        <p class="card-text">Visualize todos os pacientes cadastrados com paginação.</p>
                                        <a href="{{ route('atepacie.list') }}" class="btn btn-primary">
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

