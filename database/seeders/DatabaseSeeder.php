<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Surgery;
use App\Models\Unity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
           
            UserTypeSeeder::class,
            InstitutionSeeder::class,
            UserSeeder::class,
        ]);
      
    }
}
