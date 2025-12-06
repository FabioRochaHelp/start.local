<x-layout title='Editar Agendamento'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateagencindex') }}">Agendamentos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Editar Agendamento</h6>
                        <a href="{{ route('ateagenclist') }}" class="ms-text-primary">Lista de Agendamentos</a>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($agendamento))
                            @php
                                // Verifica se os dados vêm estruturados
                                $isStructured = isset($agendamento['agendamento']);
                                $agendamentoData = $isStructured ? ($agendamento['agendamento'] ?? []) : $agendamento;
                                $id = $agendamentoData['NNUMEGENC'] ?? $agendamentoData['NNUMEAGENC'] ?? '';
                            @endphp
                            <form method="POST" action="{{ route('ateagencupdate', ['id' => $id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="NNUMECONSU">Número da Consulta (NNUMECONSU)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="NNUMECONSU" 
                                               name="NNUMECONSU" 
                                               value="{{ $agendamentoData['NNUMECONSU'] ?? '' }}"
                                               placeholder="Número da consulta">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="NNUMEPACIE">Número do Paciente (NNUMEPACIE)</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="NNUMEPACIE" 
                                               name="NNUMEPACIE" 
                                               value="{{ $agendamentoData['NNUMEPACIE'] ?? '' }}"
                                               placeholder="Número do paciente">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>ID do Agendamento</label>
                                        <input type="text" 
                                               class="form-control" 
                                               value="{{ $id }}"
                                               readonly>
                                        <small class="text-muted">ID não pode ser alterado</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <small class="text-muted">
                                            <strong>Nota:</strong> Preencha apenas os campos que deseja atualizar.
                                        </small>
                                    </div>
                                </div>
                                <button class="btn btn-warning mt-4 d-inline w-20" type="reset">Limpar</button>
                                <button class="btn btn-primary mt-4 d-inline w-20" type="submit">Atualizar</button>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> Agendamento não encontrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

