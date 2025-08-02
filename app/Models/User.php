<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'email',
        'password',
        'age',
        'cpf',
        'phone',
        'role_id',
        'tenant_id',
        'user_type_id'
    ];

    public function collaborator(): HasOne
    {
        return $this->hasOne(Collaborator::class);
    }

    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }
}
