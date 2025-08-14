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
        'user_type_id',
        'created_at',
    ];

    protected $casts = [
      'created_at' => 'datetime:d/m/Y',
    ];


    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

}
