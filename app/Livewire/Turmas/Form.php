<?php

namespace App\Livewire\Turmas;

use App\Models\Pessoa;
use App\Models\Turma;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public ?Turma $turma = null;

    public $nome = '';
    public $ano_letivo;
    public $serie = '';
    public $turno = '';
    public $capacidade_maxima;
    public $sala = '';
    public $professor_titular_id = null;
    public $ativo = 1;

    public function mount(Turma $turma = null): void
    {
        if ($turma && $turma->exists) {
            $this->turma = $turma;
            $this->fill([
                'nome' => $turma->nome,
                'ano_letivo' => $turma->ano_letivo,
                'serie' => $turma->serie,
                'turno' => $turma->turno,
                'capacidade_maxima' => $turma->capacidade_maxima,
                'sala' => $turma->sala,
                'professor_titular_id' => $turma->professor_titular_id,
                'ativo' => $turma->ativo ? 1 : 0,
            ]);
        }
    }

    protected function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'ano_letivo' => ['required', 'integer', 'min:2000', 'max:2100'],
            'serie' => ['required', 'string', 'max:50'],
            'turno' => ['required', Rule::in(array_keys(Turma::TURNOS))],
            'capacidade_maxima' => ['required', 'integer', 'min:1', 'max:200'],
            'sala' => ['required', 'string', 'max:50'],
            'professor_titular_id' => ['nullable', 'integer', 'exists:pessoas,id'],
            'ativo' => ['boolean'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->turma) {
            $this->turma->update($data);
            session()->flash('success', 'Turma atualizada com sucesso!');
        } else {
            Turma::create($data);
            session()->flash('success', 'Turma criada com sucesso!');
        }

        return redirect()->route('turmas.index');
    }

    public function render()
    {
        $professores = Pessoa::query()
            ->where('tipo', 'PROFESSOR')
            ->orderBy('nome_completo')
            ->get();

        return view('livewire.turmas.form', [
            'turnos' => Turma::TURNOS,
            'professores' => $professores,
        ]);
    }
}


