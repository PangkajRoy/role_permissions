<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create New Role
        Role::create(['name' => 'Super Admin', 'guard_name' => 'admin']);
        $roleAdmin = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);

        //Permission list in array
        $permissions = [
            [
                'guard_name' => 'admin',
                'group_name' => 'Dashboard',
                'permissions' => [
                    'View Dashboard',
                    'Edit Dashboard',
                ]
            ],
            [
                'guard_name' => 'admin',
                'group_name' => 'Blog',
                'permissions' => [
                    'View Blog',
                    'Create Blog',
                    'Edit Blog',
                    'Delete Blog',
                ]
            ],
            [
                'guard_name' => 'admin',
                'group_name' => 'Admin',
                'permissions' => [
                    'View Admin',
                    'Create Admin',
                    'Edit Admin',
                    'Delete Admin',
                ]
            ],
            [
                'guard_name' => 'admin',
                'group_name' => 'Role',
                'permissions' => [
                    'View Role',
                    'Create Role',
                    'Edit Role',
                    'Delete Role',
                ]
            ],
            [
                'guard_name' => 'admin',
                'group_name' => 'Permission',
                'permissions' => [
                    'View Permission',
                    'Create Permission',
                    'Edit Permission',
                    'Delete Permission',
                ]
            ],
        ];

        //assign permissions to roles

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGuard = $permissions[$i]['guard_name'];
            $permissionGroup = $permissions[$i]['group_name'];
            for($j=0; $j < count($permissions[$i]['permissions']); $j++) {
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => $permissionGuard, 'group_name' => $permissionGroup]);
                $roleAdmin->givePermissionTo($permission);
                $permission->assignRole($roleAdmin);
            }           
        }
    }
}
