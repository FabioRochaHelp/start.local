<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $userTypes = [
            ['name' => 'Webmaster'],
            ['name' => 'Administrator'],
            ['name' => 'Moderator'],
        ];

        foreach ($userTypes as $userType) {
            \App\Models\UserType::create($userType);
        }

    }
}
