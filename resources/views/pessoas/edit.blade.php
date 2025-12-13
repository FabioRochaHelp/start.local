<x-layout title="Editar Pessoa">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-user-edit"></i> Editar Pessoa</h1>
            <a href="{{ route('pessoas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <livewire:pessoas.form :pessoa="$pessoa" />
    </div>
</x-layout>