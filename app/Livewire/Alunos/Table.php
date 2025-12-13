<?php

namespace App\Livewire\Alunos;

use Livewire\Component;
use App\Models\Aluno;

class Table extends Component
{
    public function render()
    {
        $query = Aluno::with('pessoa');

        return view('livewire.alunos.table', [
            'alunos'    => $query->orderBy('matricula')->get(),
            'turnos'    => Aluno::TURNOS,
            'situacoes' => Aluno::SITUACOES,
        ]);
    }
}
