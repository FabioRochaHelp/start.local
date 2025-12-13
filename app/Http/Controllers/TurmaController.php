<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TurmaController extends Controller
{
    public function index(): View
    {
        return view('turmas.index');
    }

    public function create(): View
    {
        return view('turmas.create');
    }

    public function show(Turma $turma): View
    {
        $turma->load('professorTitular');
        return view('turmas.show', compact('turma'));
    }

    public function edit(Turma $turma): View
    {
        return view('turmas.edit', compact('turma'));
    }

    public function destroy(Turma $turma): RedirectResponse
    {
        $turma->delete();
        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}


