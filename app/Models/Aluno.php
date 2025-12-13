<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'alunos';

    protected $fillable = [
        'pessoa_id',
        'matricula',
        'data_ingresso',
        'turno',
        'situacao',
        'responsavel_financeiro_id',
        'observacoes',
    ];

    protected $casts = [
        'data_ingresso' => 'date',
    ];

    /* ------------------ Constantes ------------------ */

    public const TURNOS = [
        'MATUTINO'  => 'Matutino',
        'VESPERTINO'=> 'Vespertino',
        'NOTURNO'   => 'Noturno',
    ];

    public const SITUACOES = [
        'ATIVO'    => 'Ativo',
        'TRANCADO' => 'Trancado',
        'FORMADO'  => 'Formado',
        'EVADIDO'  => 'Evadido',
    ];

    /* ------------------ Relations ------------------ */

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }

    public function responsavelFinanceiro()
    {
        return $this->belongsTo(Pessoa::class, 'responsavel_financeiro_id');
    }

    /* ------------------ Helpers ------------------ */

    public static function getTurnos(): array
    {
        return self::TURNOS;
    }

    public static function getSituacoes(): array
    {
        return self::SITUACOES;
    }

    public function getTurnoLabelAttribute(): string
    {
        return self::TURNOS[$this->turno] ?? $this->turno;
    }

    public function getSituacaoLabelAttribute(): string
    {
        return self::SITUACOES[$this->situacao] ?? $this->situacao;
    }
}
