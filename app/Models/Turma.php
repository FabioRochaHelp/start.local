<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = [
        'nome',
        'ano_letivo',
        'serie',
        'turno',
        'capacidade_maxima',
        'sala',
        'professor_titular_id',
        'ativo',
    ];

    protected $casts = [
        'ano_letivo' => 'integer',
        'capacidade_maxima' => 'integer',
        'ativo' => 'boolean',
    ];

    public const TURNOS = [
        'MATUTINO' => 'Matutino',
        'VESPERTINO' => 'Vespertino',
        'NOTURNO' => 'Noturno',
    ];

    public static function getTurnos(): array
    {
        return self::TURNOS;
    }

    public function professorTitular()
    {
        return $this->belongsTo(Pessoa::class, 'professor_titular_id');
    }
}


