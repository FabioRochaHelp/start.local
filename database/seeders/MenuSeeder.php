<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $menus = [
            ['name' => 'Configurações', 'url' => 'settings', 'icon' => 'settings'],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}
