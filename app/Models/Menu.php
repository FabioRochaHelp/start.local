<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'icon',    
    ];

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class);
    }

    public function menuUsersTypes()
    {
        return $this->hasMany(MenuUsersType::class);
    }

    public function userTypes()
    {
        return $this->belongsToMany(UserType::class, 'menu_users_types', 'menu_id', 'user_type_id');
    }
}
