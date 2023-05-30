<?php

namespace Database\Seeders\Skijasi\Post;

use Illuminate\Database\Seeder;

class SkijasiPostModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PostMenusSeeder::class);
        $this->call(PostFixedMenuItemSeeder::class);
        $this->call(PostRolesSeeder::class);
        $this->call(PostPermissionsSeeder::class);
        $this->call(PostRolePermissionsSeeder::class);
    }
}
