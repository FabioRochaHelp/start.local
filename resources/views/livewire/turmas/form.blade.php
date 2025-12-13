<div>
    <form wire:submit.prevent="save" class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="nome" class="form-control @error('nome') is-invalid @enderror">
                    @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ano Letivo <span class="text-danger">*</span></label>
                    <input type="number" wire:model.defer="ano_letivo" class="form-control @error('ano_letivo') is-invalid @enderror">
                    @error('ano_letivo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Série <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="serie" class="form-control @error('serie') is-invalid @enderror">
                    @error('serie')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mt-1">
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
                    <label class="form-label">Capacidade Máxima <span class="text-danger">*</span></label>
                    <input type="number" wire:model.defer="capacidade_maxima" class="form-control @error('capacidade_maxima') is-invalid @enderror">
                    @error('capacidade_maxima')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sala <span class="text-danger">*</span></label>
                    <input type="text" wire:model.defer="sala" class="form-control @error('sala') is-invalid @enderror">
                    @error('sala')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-8">
                    <label class="form-label">Professor Titular</label>
                    <select wire:model.defer="professor_titular_id" class="form-select @error('professor_titular_id') is-invalid @enderror">
                        <option value="">Nenhum</option>
                        @foreach($professores as $prof)
                            <option value="{{ $prof->id }}">{{ $prof->nome_completo }}</option>
                        @endforeach
                    </select>
                    @error('professor_titular_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select wire:model.defer="ativo" class="form-select">
                        <option value="1">Ativa</option>
                        <option value="0">Inativa</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</div>


