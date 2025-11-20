<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubMenu;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subMenus = [
            ['name' => 'Permissões', 'url' => 'menu', 'icon' => 'fa fa-bar', 'menu_id' => 1],
        ];

        foreach ($subMenus as $subMenu) {
            SubMenu::create($subMenu);
        }

    }
}
