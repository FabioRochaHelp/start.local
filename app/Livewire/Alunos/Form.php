<?php

namespace App\Livewire\Alunos;

use App\Models\Aluno;
use App\Models\Pessoa;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Form extends Component
{
    public ?Aluno $aluno = null;
    public $pessoa_id = '';
    public ?Pessoa $pessoaSelecionada = null;

    // Aluno
    public $matricula = '';
    public $data_ingresso;
    public $turno = '';
    public $situacao = 'ATIVO';
    public $responsavel_financeiro_id = null;
    public $observacoes = '';

    public function mount(Aluno $aluno = null): void
    {
        if ($aluno && $aluno->exists) {
            $this->aluno = $aluno->load('pessoa');
            $this->pessoa_id = $this->aluno->pessoa_id;
            $this->pessoaSelecionada = $this->aluno->pessoa;

            $this->fill([
                // aluno
                'matricula' => $this->aluno->matricula,
                'data_ingresso' => optional($this->aluno->data_ingresso)->format('Y-m-d'),
                'turno' => $this->aluno->turno,
                'situacao' => $this->aluno->situacao,
                'responsavel_financeiro_id' => $this->aluno->responsavel_financeiro_id,
                'observacoes' => $this->aluno->observacoes,
            ]);
        }
    }

    public function updatedPessoaId(): void
    {
        $this->pessoaSelecionada = $this->pessoa_id
            ? Pessoa::find($this->pessoa_id)
            : null;
    }

    protected function rules(): array
    {
        $alunoId = $this->aluno?->id;
        $pessoaIdAtual = $this->aluno?->pessoa_id;

        return [
            'pessoa_id' => [
                'required',
                'integer',
                'exists:pessoas,id',
                Rule::unique('alunos', 'pessoa_id')->ignore($pessoaIdAtual, 'pessoa_id'),
            ],

            // aluno
            'matricula' => ['required', 'string', 'max:50', Rule::unique('alunos', 'matricula')->ignore($alunoId)],
            'data_ingresso' => ['required', 'date'],
            'turno' => ['required', Rule::in(array_keys(Aluno::TURNOS))],
            'situacao' => ['required', Rule::in(array_keys(Aluno::SITUACOES))],
            'responsavel_financeiro_id' => ['nullable', 'integer', 'exists:pessoas,id'],
            'observacoes' => ['nullable', 'string'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->aluno) {
            $this->aluno->update([
                'pessoa_id' => $data['pessoa_id'],
                'matricula' => $data['matricula'],
                'data_ingresso' => $data['data_ingresso'],
                'turno' => $data['turno'],
                'situacao' => $data['situacao'],
                'responsavel_financeiro_id' => $data['responsavel_financeiro_id'],
                'observacoes' => $data['observacoes'],
            ]);
        } else {
            Aluno::create([
                'pessoa_id' => $data['pessoa_id'],
                'matricula' => $data['matricula'],
                'data_ingresso' => $data['data_ingresso'],
                'turno' => $data['turno'],
                'situacao' => $data['situacao'],
                'responsavel_financeiro_id' => $data['responsavel_financeiro_id'],
                'observacoes' => $data['observacoes'],
            ]);
        }

        session()->flash('success', $this->aluno ? 'Aluno atualizado com sucesso!' : 'Aluno criado com sucesso!');

        return redirect()->route('alunos.index');
    }

    public function render()
    {
        $pessoasDisponiveis = Pessoa::query()
            ->where('tipo', 'ALUNO')
            ->whereNotIn('id', Aluno::query()->pluck('pessoa_id')->all())
            ->orderBy('nome_completo')
            ->get();

        $responsaveis = Pessoa::query()
            ->where('tipo', 'RESPONSAVEL')
            ->orderBy('nome_completo')
            ->get();

        return view('livewire.alunos.form', [
            'turnos' => Aluno::TURNOS,
            'situacoes' => Aluno::SITUACOES,
            'responsaveis' => $responsaveis,
            'pessoasDisponiveis' => $pessoasDisponiveis,
        ]);
    }
}


