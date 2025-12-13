<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pessoa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pessoas';

    protected $fillable = [
        'tipo',
        'nome_completo',
        'cpf',
        'data_nascimento',
        'email',
        'telefone',
        'endereco',
        'photo_path',
        'ativo',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'ativo' => 'boolean',
    ];

    public const TIPOS = [
        'ALUNO'       => 'Aluno',
        'FUNCIONARIO' => 'Funcionário',
        'PROFESSOR'   => 'Professor',
        'RESPONSAVEL' => 'Responsável',
    ];

    /* ----------------- Accessors ----------------- */

    public function getCpfFormatadoAttribute(): string
    {
        $cpf = preg_replace('/\D/', '', $this->cpf);
        return vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($cpf));
    }

    public function getTelefoneFormatadoAttribute(): string
    {
        $tel = preg_replace('/\D/', '', $this->telefone);
        if (strlen($tel) === 11) {
            return sprintf('(%s%s) %s%s%s%s%s-%s%s%s%s', ...str_split($tel));
        }
        return $this->telefone;
    }

    /* ----------------- Mutators ----------------- */

    public function setCpfAttribute($value): void
    {
        $this->attributes['cpf'] = preg_replace('/\D/', '', $value);
    }

    public function setTelefoneAttribute($value): void
    {
        $this->attributes['telefone'] = preg_replace('/\D/', '', $value);
    }

    /* ----------------- Helpers ----------------- */

    public function toggleStatus(): void
    {
        $this->ativo = ! $this->ativo;
        $this->save();
    }

    /*----------------- Accessor: Photo URL -----------------*/
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path
            ? asset('storage/pessoas/' . $this->photo_path)
            : asset('images/avatar-placeholder.png');
    }

    /*----------------- Helper -----------------*/
    public static function getTipos(): array
    {
        return self::TIPOS;
    }

    /*----------------- Mutator: Nome Completo UpperCase -----------------*/
    public function setNomeCompletoAttribute(string $value): void
    {
        $this->attributes['nome_completo'] = Str::upper($value);
    }
}
