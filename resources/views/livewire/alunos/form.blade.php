<form wire:submit.prevent="save" class="card">
    <div class="card-body">
        <h5 class="mb-3"><i class="fas fa-id-card"></i> Dados do Aluno</h5>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Pessoa (Aluno) <span class="text-danger">*</span></label>
                <select wire:model="pessoa_id" class="form-select @error('pessoa_id') is-invalid @enderror" {{ $aluno ? 'disabled' : '' }}>
                    <option value="">Selecione uma pessoa...</option>
                    @foreach($pessoasDisponiveis as $p)
                        <option value="{{ $p->id }}">{{ $p->nome_completo }} (CPF: {{ $p->cpf_formatado }})</option>
                    @endforeach
                </select>
                @error('pessoa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                @if($aluno)
                    <small class="text-muted">Para trocar a pessoa vinculada, ajuste diretamente no banco ou me peça que habilito a troca.</small>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Matrícula <span class="text-danger">*</span></label>
                <input type="text" wire:model.defer="matricula" class="form-control @error('matricula') is-invalid @enderror">
                @error('matricula')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">Data de Ingresso <span class="text-danger">*</span></label>
                <input type="date" wire:model.defer="data_ingresso" class="form-control @error('data_ingresso') is-invalid @enderror">
                @error('data_ingresso')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-4">
                <label class="form-label">Situação <span class="text-danger">*</span></label>
                <select wire:model.defer="situacao" class="form-select @error('situacao') is-invalid @enderror">
                    @foreach($situacoes as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
                @error('situacao')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Turno <span class="text-danger">*</span></label>
                <select wire:model.defer="turno" class="form-select @error('turno') is-invalid @enderror">
                    <option value="">Selecione</option>
                    @foreach($turnos as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
                @error('turno')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Responsável Financeiro</label>
                <select wire:model.defer="responsavel_financeiro_id" class="form-select @error('responsavel_financeiro_id') is-invalid @enderror">
                    <option value="">Nenhum</option>
                    @foreach($responsaveis as $resp)
                        <option value="{{ $resp->id }}">{{ $resp->nome_completo }}</option>
                    @endforeach
                </select>
                @error('responsavel_financeiro_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Observações</label>
            <textarea wire:model.defer="observacoes" rows="3" class="form-control @error('observacoes') is-invalid @enderror"></textarea>
            @error('observacoes')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        @if($pessoaSelecionada)
            <hr class="my-4">
            <h6 class="mb-2">Pessoa selecionada</h6>
            <div class="d-flex align-items-center gap-3">
                <img src="{{ $pessoaSelecionada->photo_url }}" class="rounded-circle border" width="56" height="56" alt="Foto">
                <div>
                    <div><strong>{{ $pessoaSelecionada->nome_completo }}</strong></div>
                    <div class="text-muted">CPF: {{ $pessoaSelecionada->cpf_formatado }} | Email: {{ $pessoaSelecionada->email }}</div>
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </div>
</form>


