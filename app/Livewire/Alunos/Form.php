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

    // Modal: Nova Pessoa (Aluno)
    public $np_nome_completo = '';
    public $np_cpf = '';
    public $np_data_nascimento;
    public $np_email = '';
    public $np_telefone = '';
    public $np_endereco = '';
    public $np_ativo = 1;

    // Modal: Novo Responsável (Pessoa tipo RESPONSAVEL)
    public $nr_nome_completo = '';
    public $nr_cpf = '';
    public $nr_data_nascimento;
    public $nr_email = '';
    public $nr_telefone = '';
    public $nr_endereco = '';
    public $nr_ativo = 1;

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

    protected function rulesNovaPessoaAluno(): array
    {
        return [
            'np_nome_completo' => ['required', 'string', 'max:255'],
            'np_cpf' => ['required', 'digits:11', Rule::unique('pessoas', 'cpf')],
            'np_data_nascimento' => ['required', 'date'],
            'np_email' => ['required', 'email', 'max:255', Rule::unique('pessoas', 'email')],
            'np_telefone' => ['required', 'string', 'min:10', 'max:15'],
            'np_endereco' => ['required', 'string', 'max:500'],
            'np_ativo' => ['boolean'],
        ];
    }

    protected function rulesNovoResponsavel(): array
    {
        return [
            'nr_nome_completo' => ['required', 'string', 'max:255'],
            'nr_cpf' => ['required', 'digits:11', Rule::unique('pessoas', 'cpf')],
            'nr_data_nascimento' => ['required', 'date'],
            'nr_email' => ['required', 'email', 'max:255', Rule::unique('pessoas', 'email')],
            'nr_telefone' => ['required', 'string', 'min:10', 'max:15'],
            'nr_endereco' => ['required', 'string', 'max:500'],
            'nr_ativo' => ['boolean'],
        ];
    }

    public function criarPessoaAluno(): void
    {
        $data = $this->validate($this->rulesNovaPessoaAluno());

        $pessoa = Pessoa::create([
            'tipo' => 'ALUNO',
            'nome_completo' => $data['np_nome_completo'],
            'cpf' => $data['np_cpf'],
            'data_nascimento' => $data['np_data_nascimento'],
            'email' => $data['np_email'],
            'telefone' => $data['np_telefone'],
            'endereco' => $data['np_endereco'],
            'ativo' => (bool) $data['np_ativo'],
        ]);

        // selecionar automaticamente
        $this->pessoa_id = (string) $pessoa->id;
        $this->pessoaSelecionada = $pessoa;

        // limpar campos modal
        $this->reset(['np_nome_completo','np_cpf','np_data_nascimento','np_email','np_telefone','np_endereco','np_ativo']);
        $this->np_ativo = 1;

        $this->dispatch('close-modal', id: 'modalNovaPessoaAluno');
    }

    public function criarResponsavel(): void
    {
        $data = $this->validate($this->rulesNovoResponsavel());

        $pessoa = Pessoa::create([
            'tipo' => 'RESPONSAVEL',
            'nome_completo' => $data['nr_nome_completo'],
            'cpf' => $data['nr_cpf'],
            'data_nascimento' => $data['nr_data_nascimento'],
            'email' => $data['nr_email'],
            'telefone' => $data['nr_telefone'],
            'endereco' => $data['nr_endereco'],
            'ativo' => (bool) $data['nr_ativo'],
        ]);

        $this->responsavel_financeiro_id = $pessoa->id;

        $this->reset(['nr_nome_completo','nr_cpf','nr_data_nascimento','nr_email','nr_telefone','nr_endereco','nr_ativo']);
        $this->nr_ativo = 1;

        $this->dispatch('close-modal', id: 'modalNovoResponsavel');
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
            ->when(!$this->aluno, function ($q) {
                $q->whereNotIn('id', Aluno::query()->pluck('pessoa_id')->all());
            })
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


