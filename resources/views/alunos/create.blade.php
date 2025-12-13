<x-layout title="Novo Aluno">
    <div class="ms-content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-user-graduate"></i> Novo Aluno</h1>
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </div>

        <livewire:alunos.form />
    </div>
</x-layout>


