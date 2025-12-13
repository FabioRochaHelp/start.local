<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PessoaController extends Controller
{
    public function index(): View
    {
        return view('pessoas.index');
    }

    public function create(): View
    {
        return view('pessoas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tipo'            => 'required|in:' . implode(',', array_keys(Pessoa::TIPOS)),
            'nome_completo'    => 'required|string|max:255',
            'cpf'              => 'required|digits:11|unique:pessoas,cpf',
            'data_nascimento'  => 'required|date',
            'email'            => 'required|email|max:255|unique:pessoas,email',
            'telefone'         => 'required|string|min:10|max:15',
            'endereco'         => 'required|string|max:500',
            'ativo'            => 'boolean',
        ]);

        Pessoa::create($data);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa criada com sucesso!');
    }

    public function show(Pessoa $pessoa): View
    {
        return view('pessoas.show', compact('pessoa'));
    }

    public function edit(Pessoa $pessoa): View
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    public function update(Request $request, Pessoa $pessoa): RedirectResponse
    {
        $data = $request->validate([
            'tipo'            => 'required|in:' . implode(',', array_keys(Pessoa::TIPOS)),
            'nome_completo'    => 'required|string|max:255',
            'cpf'              => 'required|digits:11|unique:pessoas,cpf,' . $pessoa->id,
            'data_nascimento'  => 'required|date',
            'email'            => 'required|email|max:255|unique:pessoas,email,' . $pessoa->id,
            'telefone'         => 'required|string|min:10|max:15',
            'endereco'         => 'required|string|max:500',
            'ativo'            => 'boolean',
        ]);

        $pessoa->update($data);

        return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso!');
    }

    public function destroy(Pessoa $pessoa): RedirectResponse
    {
        $pessoa->delete();
        return redirect()->route('pessoas.index')->with('success', 'Pessoa excluída com sucesso!');
    }

    public function toggleStatus(Pessoa $pessoa): RedirectResponse
    {
        $pessoa->toggleStatus();
        return back();
    }

    public function restore(int $id): RedirectResponse
    {
        $pessoa = Pessoa::withTrashed()->findOrFail($id);
        $pessoa->restore();
        return back();
    }

    // ---------------------- Photo ----------------------
    public function photo(Request $request, Pessoa $pessoa): RedirectResponse
    {
        $data = $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $filename = Str::uuid() . '.' . $data['photo']->extension();
        $path = $data['photo']->storeAs('pessoas', $filename, 'public');

        $pessoa->update(['photo_path' => basename($path)]);

        return back()->with('success', 'Foto atualizada!');
    }
}
