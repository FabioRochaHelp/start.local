<x-layout title='Editar Paciente'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('atepacie.index') }}">Pacientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Editar Paciente</h6>
                        <a href="{{ route('atepacie.list') }}" class="ms-text-primary">Lista de Pacientes</a>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($paciente))
                            <form method="POST" action="{{ route('atepacie.update', ['numero' => $paciente['NNUMEPACIE'] ?? '']) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="CNOMEPACIE">Nome do Paciente <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="CNOMEPACIE" 
                                               name="CNOMEPACIE" 
                                               value="{{ $paciente['CNOMEPACIE'] ?? '' }}"
                                               placeholder="Nome completo"
                                               required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="CCPF_PACIE">CPF</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="CCPF_PACIE" 
                                               name="CCPF_PACIE" 
                                               value="{{ $paciente['CCPF_PACIE'] ?? '' }}"
                                               placeholder="000.000.000-00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="CDOCUPACIE">Documento</label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="CDOCUPACIE" 
                                               name="CDOCUPACIE" 
                                               value="{{ $paciente['CDOCUPACIE'] ?? '' }}"
                                               placeholder="Documento">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="NNUMEPACIE">Número do Paciente</label>
                                        <input type="number" 
                                               class="form-control" 
                                               id="NNUMEPACIE" 
                                               name="NNUMEPACIE" 
                                               value="{{ $paciente['NNUMEPACIE'] ?? '' }}"
                                               placeholder="Número"
                                               readonly>
                                        <small class="text-muted">Número não pode ser alterado</small>
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
                                <i class="material-icons">error</i> Paciente não encontrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

