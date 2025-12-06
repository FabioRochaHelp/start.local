<x-layout title='Adicionar Agendamento'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateagencindex') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Adicionar Agendamento</h6>
                        <a href="{{ route('ateagenclist') }}" class="ms-text-primary">Lista de Agendamentos</a>
                    </div>
                    <div class="ms-panel-body">
                        <form method="POST" action="{{ route('ateagencstore') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="NNUMECONSU">Número da Consulta (NNUMECONSU)</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="NNUMECONSU" 
                                           name="NNUMECONSU" 
                                           placeholder="Número da consulta">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="NNUMEPACIE">Número do Paciente (NNUMEPACIE)</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="NNUMEPACIE" 
                                           name="NNUMEPACIE" 
                                           placeholder="Número do paciente">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <small class="text-muted">
                                        <strong>Nota:</strong> Preencha os campos conforme necessário. 
                                        Outros campos podem ser adicionados conforme a estrutura da tabela ATEGENC.
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

