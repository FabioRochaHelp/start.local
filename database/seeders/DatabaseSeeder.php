<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserType;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\MenuUsersType;
use App\Models\SubMenuUsersType;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SubMenuSeeder::class,
            MenuUsersTypeSeeder::class,
            SubMenuUsersTypeSeeder::class
        ]);
    }
}
