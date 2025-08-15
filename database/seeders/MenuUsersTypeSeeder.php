<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuUsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $menuUsersTypes = [
            ['menu_id' => 1, 'user_type_id' => 1],
        ];

        foreach ($menuUsersTypes as $menuUserType) {
            \App\Models\MenuUsersType::create($menuUserType);
        }

        
    }
}
