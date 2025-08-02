<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::updateOrCreate(
            [
                'name' => 'Admin - StartKit',
                'email' => 'admin@' . env('APP_DOMAIN'),
                'age' => 0,
                'cpf' => 0,
                'password' => Hash::make('password'),
                'user_type_id' => 1,
            ],
        );
    }
}
