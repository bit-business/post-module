<?php

namespace Database\Seeders\Skijasi\Post;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use NadzorServera\Skijasi\Models\Permission;
use NadzorServera\Skijasi\Models\Role;
use NadzorServera\Skijasi\Models\RolePermission;

class PostRolePermissionsSeeder extends Seeder
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
            $editor = Role::where('name', 'editor')->firstOrFail();

            $permission = ['posts', 'categories', 'tags'];

            $permissions = Permission::where(function ($query) use ($permission) {
                for ($i = 0; $i < count($permission); $i++) {
                    $query->orWhere('key', 'like', '%'.$permission[$i]);
                }
            })->get();

            if (! is_null($editor)) {
                foreach ($permissions as $row) {
                    $role_permission = RolePermission::where('role_id', $editor->id)
                            ->where('permission_id', $row->id)
                            ->first();
                    if (is_null($role_permission)) {
                        $role_permission = new RolePermission();
                        $role_permission->role_id = $editor->id;
                        $role_permission->permission_id = $row->id;
                        $role_permission->save();
                    }
                }
            }

            DB::commit();
        } catch (Exception $e) {
            throw new Exception('Exception occur '.$e);
            DB::rollBack();
        }
    }
}
