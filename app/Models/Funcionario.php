<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = [
        'pessoa_id',
        'matricula_funcional',
        'cargo',
        'formacao',
        'data_admissao',
        'salario_base',
        'carga_horaria_semanal',
        'banco',
        'agencia',
        'conta_corrente',
    ];

    protected $casts = [
        'data_admissao' => 'date',
        'salario_base' => 'decimal:2',
        'carga_horaria_semanal' => 'integer',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
}


