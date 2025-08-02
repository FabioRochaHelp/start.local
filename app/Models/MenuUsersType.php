<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuUsersType extends Model
{
    use HasFactory;

    protected $table = 'menu_users_types';

    protected $fillable = [
        'menu_id',
        'user_type_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }
}
