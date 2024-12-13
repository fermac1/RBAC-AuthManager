<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        $asuperAdminPermissions = Permission::all();
        $superAdmin->permissions()->sync($asuperAdminPermissions);


        $adminPermissions = Permission::all();
        $admin->permissions()->sync($adminPermissions);


        $userPermissions = Permission::where('name', 'view-users')->get();
        $user->permissions()->sync($userPermissions);
    }
}
