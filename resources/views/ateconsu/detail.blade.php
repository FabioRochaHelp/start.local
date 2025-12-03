<x-layout title='Detalhes da Consulta'>
    <div class="ms-content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-0">
                        <li class="breadcrumb-item"><i class="material-icons">home</i> <a
                                href="{{ route('home.view') }}">Home</a> </li>
                        <li class="breadcrumb-item"><a href="{{ route('ateconsu.index') }}">Consultas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                    </ol>
                </nav>
                <div class="ms-panel">
                    <div class="ms-panel-header ms-panel-custome">
                        <h6>Detalhes da Consulta</h6>
                        <div>
                            <a href="{{ route('ateconsu.index') }}" class="ms-text-primary">Voltar</a>
                            @if(isset($consulta) && isset($consulta['NNUMECONSU']))
                                <a href="{{ route('ateconsu.edit', ['numero' => $consulta['NNUMECONSU']]) }}" class="ms-text-primary ms-3">Editar</a>
                            @endif
                        </div>
                    </div>
                    <div class="ms-panel-body">
                        @if(isset($error))
                            <div class="alert alert-danger">
                                <i class="material-icons">error</i> {{ $error }}
                            </div>
                        @endif

                        @if(isset($consulta) && !empty($consulta))
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        <i class="material-icons">medical_services</i> Informações da Consulta
                                    </h5>
                                    <div class="row">
                                        @foreach($consulta as $key => $value)
                                            <div class="col-md-6 mb-3">
                                                <strong>{{ $key }}:</strong>
                                                <div class="mt-1">
                                                    @if(is_array($value))
                                                        <pre class="bg-light p-2 rounded">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                    @elseif(is_bool($value))
                                                        {{ $value ? 'Sim' : 'Não' }}
                                                    @else
                                                        {{ $value ?? 'N/A' }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="material-icons">info</i> Nenhum dado da consulta disponível.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

