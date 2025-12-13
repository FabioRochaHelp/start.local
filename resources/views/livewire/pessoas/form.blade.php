<form wire:submit.prevent="save" class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Tipo <span class="text-danger">*</span></label>
                <select wire:model.defer="tipo" class="form-select @error('tipo') is-invalid @enderror">
                    <option value="">Selecione</option>
                    @foreach($tipos as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
                @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select wire:model.defer="ativo" class="form-select">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Nome Completo *</label>
            <input type="text" wire:model.defer="nome_completo" class="form-control @error('nome_completo') is-invalid @enderror">
            @error('nome_completo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-4">
                <label class="form-label">CPF *</label>
                <input type="text" wire:model.defer="cpf" class="form-control @error('cpf') is-invalid @enderror">
                @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Data Nascimento *</label>
                <input type="date" wire:model.defer="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror">
                @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Telefone *</label>
                <input type="text" wire:model.defer="telefone" class="form-control @error('telefone') is-invalid @enderror">
                @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Endereço *</label>
            <textarea wire:model.defer="endereco" rows="3" class="form-control @error('endereco') is-invalid @enderror"></textarea>
            @error('endereco')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('pessoas.index') }}" class="btn btn-secondary">Cancelar</a>
            <button class="btn btn-primary" type="submit">Salvar</button>
        </div>
    </div>
</form>
