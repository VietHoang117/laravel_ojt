<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Danh sách quyền
        $permissions = [
            'view_dashboard',
            'check_in',
            'check_out',
            'view_user',
            'create_user',
            'edit_user',
            'delete_user',
            'view_department',
            'create_department',
            'edit_department',
            'delete_department',
            'view_profile',
            'view_justifications',
            'create_justifications',
            'edit_justifications',
            'delete_justifications',
            'view_configurations',
            'create_configurations',
            'edit_configurations',
            'delete_configurations',
            'view_leaves',
            'create_leaves',
            'edit_leaves',
            'delete_leaves'
    
        ];

        $permissionIds = [];
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $permissionIds[$permissionName] = $permission->id;
        }
        
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'is_system_role' => true]);
        $memberRole = Role::firstOrCreate(['name' => 'member']);

        $memberPermissions = ['view_dashboard', 'check_in', 'check_out', 'view_profile', 'view_configurations', 'create_configurations', 
        'edit_configurations', 'delete_configurations','create_justifications', 'view_leaves', 'create_leaves', 'edit_leaves', 'delete_leaves'];

        $memberRole->permissions()->sync(array_map(fn($name) => $permissionIds[$name], $memberPermissions));

    }
}