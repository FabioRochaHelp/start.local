<x-layout title="Editar Turma">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-edit"></i> Editar Turma</h1>
            <a href="{{ route('turmas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <livewire:turmas.form :turma="$turma" />
    </div>
</x-layout>


