<x-layout title="Visualizar Pessoa">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $pessoa->photo_url }}" alt="Foto" class="rounded-circle border" width="100" height="100">
                <h1 class="mb-0">{{ $pessoa->nome_completo }}</h1>
            </div>
            <div>
                <a href="{{ route('pessoas.edit', $pessoa) }}" class="btn btn-primary">
                  Editar
                </a>
                <a href="{{ route('pessoas.index') }}" class="btn btn-secondary">
                   Voltar
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Informações Pessoais</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tipo:</label>
                                <div>
                                    <span class="badge bg-secondary fs-6">
                                        {{ \App\Models\Pessoa::getTipos()[$pessoa->tipo] }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status:</label>
                                <div>
                                    @if ($pessoa->ativo)
                                        <span class="badge bg-success fs-6">Ativo</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Inativo</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nome Completo:</label>
                            <div>{{ $pessoa->nome_completo }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">CPF:</label>
                                <div class="cpf-mask">{{ $pessoa->cpf_formatado }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data de Nascimento:</label>
                                <div>{{ $pessoa->data_nascimento->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email:</label>
                                <div>
                                    <a href="mailto:{{ $pessoa->email }}">{{ $pessoa->email }}</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Telefone:</label>
                                <div class="telefone-mask">
                                    <a href="tel:{{ $pessoa->telefone }}">{{ $pessoa->telefone_formatado }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Endereço:</label>
                            <div>{{ $pessoa->endereco }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-cog"></i> Ações</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button id="openCam" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#photoModal">
                              Capturar Foto
                            </button>

                            <a href="{{ route('pessoas.edit', $pessoa) }}" class="btn btn-secondary">
                               Editar Pessoa
                            </a>

                            <form method="POST" action="{{ route('pessoas.toggle-status', $pessoa) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="btn btn-{{ $pessoa->ativo ? 'warning' : 'success' }} w-100">
                                    {{ $pessoa->ativo ? ' Desativar' : ' Ativar' }}
                                </button>
                            </form>

                           {{--  <form method="POST" action="{{ route('pessoas.destroy', $pessoa) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete w-100">
                                    <i class="fas fa-trash"></i> Excluir Pessoa
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clock"></i> Informações do Sistema</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted">Cadastrado em:</small><br>
                            {{ $pessoa->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Última atualização:</small><br>
                            {{ $pessoa->updated_at->format('d/m/Y H:i') }}
                        </div>
                        @if ($pessoa->deleted_at)
                            <div class="mb-2">
                                <small class="text-muted">Excluído em:</small><br>
                                <span class="text-danger">{{ $pessoa->deleted_at->format('d/m/Y H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Webcam -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Capturar Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <video id="video" width="640" height="480" autoplay playsinline muted <!--
                        playsinline+muted evita bloqueio em celulares -->
                        class="border"></video>
                    <canvas id="canvas" width="640" height="480" class="d-none"></canvas>
                    <div class="mt-2">
                        <button id="snap" type="button" class="btn btn-primary">Capturar</button>
                        <button id="upload" type="button" class="btn btn-success d-none">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', () => {
    
        const video     = document.getElementById('video');
        const canvas    = document.getElementById('canvas');
        const snapBtn   = document.getElementById('snap');
        const uploadBtn = document.getElementById('upload');
        let stream;
    
        // Abrir câmera
        document.getElementById('openCam').addEventListener('click', async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                video.srcObject = stream;
            } catch (err) {
                alert('Permita o acesso à câmera.');
                return;
            }
        });
    
        // Capturar frame
        snapBtn.addEventListener('click', () => {
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    
            video.classList.add('d-none');
            canvas.classList.remove('d-none');
            uploadBtn.classList.remove('d-none');
            snapBtn.classList.add('d-none');
        });
    
        // Fechar modal
        document.getElementById('photoModal').addEventListener('hidden.bs.modal', () => {
            if (stream) stream.getTracks().forEach(t => t.stop());
            video.classList.remove('d-none');
            canvas.classList.add('d-none');
            uploadBtn.classList.add('d-none');
            snapBtn.classList.remove('d-none');
        });
    
        // Enviar imagem
        uploadBtn.addEventListener('click', () => {
            canvas.toBlob(blob => {
                const formData = new FormData();
                formData.append('photo', blob, 'photo.png');
    
                fetch("{{ route('pessoas.photo', $pessoa) }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                }).then(() => window.location.reload());
            }, 'image/png');
        });
    });
    </script>
    @endpush
</x-layout>
