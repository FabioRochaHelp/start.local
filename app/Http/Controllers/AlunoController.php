<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\View\View;

class AlunoController extends Controller
{
    public function index(): View
    {
        return view('alunos.index');
    }

    public function create(): View
    {
        return view('alunos.create');
    }

    public function show(Aluno $aluno): View
    {
        $aluno->load(['pessoa', 'responsavelFinanceiro']);
        return view('alunos.show', compact('aluno'));
    }

    public function edit(Aluno $aluno): View
    {
        $aluno->load('pessoa');
        return view('alunos.edit', compact('aluno'));
    }
}


