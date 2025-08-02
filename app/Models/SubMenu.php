<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
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
        'menu_id',
    ];

    /**
     * Get the menu that owns the sub-menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function subMenuUsersTypes()
    {
        return $this->hasMany(SubMenuUsersType::class);
    }

    public function userTypes()
    {
        return $this->belongsToMany(UserType::class, 'sub_menu_users_types', 'sub_menu_id', 'user_type_id');
    }
}
