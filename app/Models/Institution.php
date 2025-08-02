<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'cnpj',
        'responsability',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(AddressInstitution::class);
    }

    protected $cast = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
