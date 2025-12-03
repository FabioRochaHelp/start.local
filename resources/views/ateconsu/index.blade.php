<x-layout title='Consultas - ATECONSU'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"> Consultas </li>
                        <li class="breadcrumb-item active" aria-current="page">ATECONSU</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Gerenciar Consultas</h6>
                        <a href="{{ route('ateconsu.create') }}" class="ms-text-primary">Adicionar Consulta</a>
                    </div>
                    <div class="ms-panel-body">
                        <div class="row">
                            <!-- Buscar por Número -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">tag</i> Buscar por Número
                                        </h5>
                                        <form action="{{ route('ateconsu.search.numero') }}" method="GET">
                                            <div class="form-group">
                                                <label for="numero">Número da Consulta (NNUMECONSU)</label>
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

                            <!-- Buscar por Nome -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">person</i> Buscar por Nome
                                        </h5>
                                        <form action="{{ route('ateconsu.search.nome') }}" method="GET">
                                            <div class="form-group">
                                                <label for="nome">Nome da Consulta</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="nome" 
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

                            <!-- Buscar por Tipo -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">category</i> Buscar por Tipo
                                        </h5>
                                        <form action="{{ route('ateconsu.search.tipo') }}" method="GET">
                                            <div class="form-group">
                                                <label for="tipo">Tipo da Consulta</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="tipo" 
                                                       name="tipo" 
                                                       placeholder="Digite o tipo"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Situação -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">info</i> Buscar por Situação
                                        </h5>
                                        <form action="{{ route('ateconsu.search.situacao') }}" method="GET">
                                            <div class="form-group">
                                                <label for="situacao">Situação da Consulta</label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       id="situacao" 
                                                       name="situacao" 
                                                       placeholder="Digite a situação"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Especialidade -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">local_hospital</i> Buscar por Especialidade
                                        </h5>
                                        <form action="{{ route('ateconsu.search.especialidade') }}" method="GET">
                                            <div class="form-group">
                                                <label for="especialidade">Código da Especialidade</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="especialidade" 
                                                       name="especialidade" 
                                                       placeholder="Digite o código"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Médico -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">medical_services</i> Buscar por Médico
                                        </h5>
                                        <form action="{{ route('ateconsu.search.medico') }}" method="GET">
                                            <div class="form-group">
                                                <label for="medico">Código do Médico</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="medico" 
                                                       name="medico" 
                                                       placeholder="Digite o código"
                                                       required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="material-icons">search</i> Buscar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Buscar por Setor -->
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <i class="material-icons">business</i> Buscar por Setor
                                        </h5>
                                        <form action="{{ route('ateconsu.search.setor') }}" method="GET">
                                            <div class="form-group">
                                                <label for="setor">Código do Setor</label>
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="setor" 
                                                       name="setor" 
                                                       placeholder="Digite o código"
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
                                            <i class="material-icons">list</i> Listar Todas as Consultas
                                        </h5>
                                        <p class="card-text">Visualize todas as consultas cadastradas com paginação.</p>
                                        <a href="{{ route('ateconsu.list') }}" class="btn btn-primary">
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

