<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AddressInstitution extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'state',
        'city',
        'nation',
        'street_name',
        'complement',
        'number',
        'neighborhood',
        'postalcode',
        'institution_id'
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
