<?php

namespace App\Livewire\Pessoas;

use Livewire\Component;
use App\Models\Pessoa;

class Table extends Component
{
    public $search = '';
    public $tipo = '';
    public $ativo = '';

    public function render()
    {
        $query = Pessoa::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nome_completo', 'like', "%{$this->search}%")
                  ->orWhere('cpf', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
            });
        }

        if ($this->tipo) {
            $query->where('tipo', $this->tipo);
        }

        if ($this->ativo !== '') {
            $query->where('ativo', $this->ativo);
        }

        return view('livewire.pessoas.table', [
            'pessoas' => $query->orderBy('nome_completo')->get(),
            'tipos'   => Pessoa::TIPOS,
        ]);
    }
}
