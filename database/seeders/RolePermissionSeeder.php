<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_permissions = \config('permission.role_has_permissions');
        foreach ($role_permissions as $permission) {
            DB::insert("INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES ({$permission['permission_id']}, {$permission['role_id']})");
        }
    }
}
