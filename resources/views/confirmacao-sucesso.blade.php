<x-guest-confirmar-layout title='Confirmação Processada'>
    <div class="row justify-content-center mx-0">
        <div class="col-12 col-md-8 col-lg-6 px-3 px-md-4">
            <div class="ms-panel">
                <div class="ms-panel-header ms-panel-custome">
                    <h6 class="mb-0">Confirmação Processada</h6>
                </div>
                <div class="ms-panel-body p-4 p-md-5 text-center">
                    <div class="mb-4">
                        <i class="material-icons display-1 text-success">check_circle</i>
                    </div>
                    
                    <h4 class="mb-3">
                        @if(session('acao') === 'confirmar')
                            Agendamento Confirmado!
                        @else
                            Agendamento Cancelado!
                        @endif
                    </h4>
                    
                    <p class="text-muted mb-4">
                        Sua solicitação foi processada com sucesso.
                        @if(session('acao') === 'confirmar')
                            Aguarde a confirmação da clínica.
                        @else
                            Seu agendamento foi cancelado.
                        @endif
                    </p>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary px-4">
                            <i class="material-icons align-middle">home</i>
                            Voltar para o Início
                        </a>
                        
                        <button onclick="window.print()" class="btn btn-outline-secondary px-4">
                            <i class="material-icons align-middle">print</i>
                            Imprimir Comprovante
                        </button>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-start">
                        <h6 class="mb-2">Informações:</h6>
                        <ul class="list-unstyled small text-muted">
                            <li><i class="material-icons align-middle text-success fs-6">check</i> Registro processado com sucesso</li>
                            <li><i class="material-icons align-middle text-success fs-6">check</i> Notificação enviada para a clínica</li>
                            <li><i class="material-icons align-middle text-success fs-6">check</i> Comprovante disponível para impressão</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-confirmar-layout>