<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenuUsersType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sub_menu_id',
        'user_type_id',
    ];

    public function subMenu()
    {
        return $this->belongsTo(SubMenu::class, 'sub_menu_id', 'id');
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }
}
