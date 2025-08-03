<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'user_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function menuUsersTypes()
    {
        return $this->hasMany(MenuUsersType::class);
    }

    public function subMenuUsersTypes()
    {
        return $this->hasMany(SubMenuUsersType::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_users_types', 'user_type_id', 'menu_id');
    }

    public function subMenus()
    {
        return $this->belongsToMany(SubMenu::class, 'sub_menu_users_types', 'user_type_id', 'sub_menu_id');
    }
}
