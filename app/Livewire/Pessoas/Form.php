<?php

namespace App\Livewire\Pessoas;

use Livewire\Component;
use App\Models\Pessoa;
use Illuminate\Validation\Rule;

class Form extends Component
{
    public ?Pessoa $pessoa = null;

    public $tipo = '';
    public $ativo = 1;
    public $nome_completo = '';
    public $cpf = '';
    public $data_nascimento;
    public $email = '';
    public $telefone = '';
    public $endereco = '';

    public function mount(Pessoa $pessoa = null): void
    {
        if ($pessoa && $pessoa->exists) {
            $this->pessoa = $pessoa;
            $this->fill($pessoa->toArray());
        }
    }

    protected function rules(): array
    {
        $uniqueCpf   = Rule::unique('pessoas', 'cpf');
        $uniqueEmail = Rule::unique('pessoas', 'email');

        if ($this->pessoa) {
            $uniqueCpf->ignore($this->pessoa->id);
            $uniqueEmail->ignore($this->pessoa->id);
        }

        return [
            'tipo'           => ['required', Rule::in(array_keys(Pessoa::TIPOS))],
            'nome_completo'  => ['required', 'string', 'max:255'],
            'cpf'            => ['required', 'digits:11', $uniqueCpf],
            'data_nascimento'=> ['required', 'date'],
            'email'          => ['required', 'email', 'max:255', $uniqueEmail],
            'telefone'       => ['required', 'string', 'min:10', 'max:15'],
            'endereco'       => ['required', 'string', 'max:500'],
            'ativo'          => ['boolean'],
        ];
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->pessoa) {
            $this->pessoa->update($data);
            session()->flash('success', 'Pessoa atualizada com sucesso!');
        } else {
            Pessoa::create($data);
            session()->flash('success', 'Pessoa criada com sucesso!');
        }

        return redirect()->route('pessoas.index');
    }

    public function render()
    {
        return view('livewire.pessoas.form', [
            'tipos' => Pessoa::TIPOS,
        ]);
    }
}
