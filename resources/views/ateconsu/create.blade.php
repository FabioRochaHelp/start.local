<x-layout title='Adicionar Consulta'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateconsu.index') }}">Consultas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Adicionar Consulta</h6>
                        <a href="{{ route('ateconsu.list') }}" class="ms-text-primary">Lista de Consultas</a>
                    </div>
                    <div class="ms-panel-body">
                        <form method="POST" action="{{ route('ateconsu.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="CNOMECONSU">Nome da Consulta <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="CNOMECONSU" 
                                           name="CNOMECONSU" 
                                           placeholder="Nome da consulta"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="CTIPOCONSU">Tipo da Consulta</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="CTIPOCONSU" 
                                           name="CTIPOCONSU" 
                                           placeholder="Tipo">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="CSITUCONSU">Situação</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="CSITUCONSU" 
                                           name="CSITUCONSU" 
                                           placeholder="Situação">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="NNUMEESPEC">Especialidade</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="NNUMEESPEC" 
                                           name="NNUMEESPEC" 
                                           placeholder="Código da especialidade">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="NEXECMEDIC">Médico Executante</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="NEXECMEDIC" 
                                           name="NEXECMEDIC" 
                                           placeholder="Código do médico">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="NSETOSETOR">Setor</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="NSETOSETOR" 
                                           name="NSETOSETOR" 
                                           placeholder="Código do setor">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <small class="text-muted">
                                        <strong>Nota:</strong> Campos marcados com * são obrigatórios. 
                                        Outros campos podem ser preenchidos conforme necessário.
                                    </small>
                                </div>
                            </div>
                            <button class="btn btn-warning mt-4 d-inline w-20" type="reset">Limpar</button>
                            <button class="btn btn-primary mt-4 d-inline w-20" type="submit">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

