<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubMenuUsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $subMenuUsersTypes = [
            ['sub_menu_id' => 1, 'user_type_id' => 1],
        ];

        foreach ($subMenuUsersTypes as $subMenuUserType) {
            \App\Models\SubMenuUsersType::create($subMenuUserType);
        }
        
    }
}
