<?php

namespace Database\Seeders;

use App\Models\Domain;
use App\Models\Institution;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        Institution::truncate();
        
        Institution::updateOrCreate([
            'status' => true,
            'name' => 'StartKit',
            'cnpj' => '12.345.678/0001-90',
            'image' => '',
            'created_at' => now(),
        ]);

      
    }
}
