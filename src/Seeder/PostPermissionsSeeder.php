<?php

namespace Database\Seeders\Skijasi\Post;

use Illuminate\Database\Seeder;
use NadzorServera\Skijasi\Models\Permission;

class PostPermissionsSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'upload_file',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key' => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('posts');

        Permission::generateFor('categories');

        Permission::generateFor('tags');

        Permission::generateFor('comments');
    }
}
