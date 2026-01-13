<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalAtendimento extends Model
{
    use HasFactory;

    protected $table = 'canal_atendimentos';

    protected $fillable = [
        'channelName',
        'channelValue',
        'tipo',
        'descricao',
        'ativo',

    ];
 
}
