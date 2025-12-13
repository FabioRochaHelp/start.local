<x-layout title="Editar Aluno">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-user-edit"></i> Editar Aluno</h1>
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <livewire:alunos.form :aluno="$aluno" />
    </div>
</x-layout>


