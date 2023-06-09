<?php

namespace Database\Seeders\Skijasi\Post;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use NadzorServera\Skijasi\Models\Role;

class PostRolesSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $roles = [
                'name' => 'editor',
                'display_name' => 'Editor',
            ];

            Role::firstOrCreate($roles);

            DB::commit();
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            DB::rollBack();
        }
    }
}
