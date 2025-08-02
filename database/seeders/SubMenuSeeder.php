<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subMenus = [
            ['name' => 'SubMenu 1', 'url' => '/submenu1', 'icon' => 'bar', 'menu_id' => 1],
            [
                'name' => 'SubMenu 2',
                'url' => '/submenu2',
                'icon' => 'sub2',
                'menu_id' => 1,
            ],
        ];
    }
}
