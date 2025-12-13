<?php

namespace App\Livewire\Turmas;

use App\Models\Turma;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return view('livewire.turmas.table', [
            'turmas' => Turma::with('professorTitular')->orderBy('ano_letivo', 'desc')->orderBy('nome')->get(),
            'turnos' => Turma::TURNOS,
        ]);
    }
}


