<div>
    <form wire:submit.prevent="save" class="card">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-id-card"></i> Dados do Aluno</h5>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label mb-1">Pessoa (Aluno) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select wire:model="pessoa_id" class="form-select @error('pessoa_id') is-invalid @enderror"
                            {{ $aluno ? 'disabled' : '' }}>
                            <option value="">Selecione uma pessoa...</option>
                            @foreach ($pessoasDisponiveis as $p)
                                <option value="{{ $p->id }}">{{ $p->nome_completo }} (CPF:
                                    {{ $p->cpf_formatado }})</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalNovaPessoaAluno">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @error('pessoa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($aluno)
                        <small class="text-muted">Para trocar a pessoa vinculada, ajuste diretamente no banco ou me peça
                            que habilito a troca.</small>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="form-label">Matrícula <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="matricula"
                        class="form-control @error('matricula') is-invalid @enderror">
                    @error('matricula')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Data de Ingresso <span class="text-danger">*</span></label>
                    <input type="date" wire:model.defer="data_ingresso"
                        class="form-control @error('data_ingresso') is-invalid @enderror">
                    @error('data_ingresso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-4">
                    <label class="form-label">Situação <span class="text-danger">*</span></label>
                    <select wire:model.defer="situacao" class="form-select @error('situacao') is-invalid @enderror">
                        @foreach ($situacoes as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('situacao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Turno <span class="text-danger">*</span></label>
                    <select wire:model.defer="turno" class="form-select @error('turno') is-invalid @enderror">
                        <option value="">Selecione</option>
                        @foreach ($turnos as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('turno')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label mb-1">Responsável Financeiro</label>
                    <div class="input-group">
                        <select wire:model.defer="responsavel_financeiro_id"
                            class="form-select @error('responsavel_financeiro_id') is-invalid @enderror">
                            <option value="">Nenhum</option>
                            @foreach ($responsaveis as $resp)
                                <option value="{{ $resp->id }}">{{ $resp->nome_completo }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalNovoResponsavel">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    @error('responsavel_financeiro_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">Observações</label>
                <textarea wire:model.defer="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror"></textarea>
                @error('observacoes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($pessoaSelecionada)
                <hr class="my-4">
                <h6 class="mb-2">Pessoa selecionada</h6>
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $pessoaSelecionada->photo_url }}" class="rounded-circle border" width="56"
                        height="56" alt="Foto">
                    <div>
                        <div><strong>{{ $pessoaSelecionada->nome_completo }}</strong></div>
                        <div class="text-muted">CPF: {{ $pessoaSelecionada->cpf_formatado }} | Email:
                            {{ $pessoaSelecionada->email }}</div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </div>
    </form>

    <!-- Modal: Nova Pessoa (Aluno) -->
    <div class="modal fade" id="modalNovaPessoaAluno" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nova Pessoa (Aluno)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text" class="form-control @error('np_nome_completo') is-invalid @enderror"
                                wire:model.defer="np_nome_completo">
                            @error('np_nome_completo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model.defer="np_ativo">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CPF *</label>
                            <input type="text" class="form-control @error('np_cpf') is-invalid @enderror"
                                wire:model.defer="np_cpf">
                            @error('np_cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data Nascimento *</label>
                            <input type="date"
                                class="form-control @error('np_data_nascimento') is-invalid @enderror"
                                wire:model.defer="np_data_nascimento">
                            @error('np_data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control @error('np_email') is-invalid @enderror"
                                wire:model.defer="np_email">
                            @error('np_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telefone *</label>
                            <input type="text" class="form-control @error('np_telefone') is-invalid @enderror"
                                wire:model.defer="np_telefone">
                            @error('np_telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Endereço *</label>
                            <textarea rows="2" class="form-control @error('np_endereco') is-invalid @enderror"
                                wire:model.defer="np_endereco"></textarea>
                            @error('np_endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click="criarPessoaAluno">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Novo Responsável -->
    <div class="modal fade" id="modalNovoResponsavel" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Responsável</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nome Completo *</label>
                            <input type="text"
                                class="form-control @error('nr_nome_completo') is-invalid @enderror"
                                wire:model.defer="nr_nome_completo">
                            @error('nr_nome_completo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" wire:model.defer="nr_ativo">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CPF *</label>
                            <input type="text" class="form-control @error('nr_cpf') is-invalid @enderror"
                                wire:model.defer="nr_cpf">
                            @error('nr_cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data Nascimento *</label>
                            <input type="date"
                                class="form-control @error('nr_data_nascimento') is-invalid @enderror"
                                wire:model.defer="nr_data_nascimento">
                            @error('nr_data_nascimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control @error('nr_email') is-invalid @enderror"
                                wire:model.defer="nr_email">
                            @error('nr_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telefone *</label>
                            <input type="text" class="form-control @error('nr_telefone') is-invalid @enderror"
                                wire:model.defer="nr_telefone">
                            @error('nr_telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Endereço *</label>
                            <textarea rows="2" class="form-control @error('nr_endereco') is-invalid @enderror"
                                wire:model.defer="nr_endereco"></textarea>
                            @error('nr_endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click="criarResponsavel">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('close-modal', (payload) => {
                    const id = payload?.id;
                    if (!id) return;
                    const el = document.getElementById(id);
                    if (!el) return;
                    const modal = bootstrap.Modal.getOrCreateInstance(el);
                    modal.hide();
                });
            });
        </script>
    @endpush

</div>
