<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Define all modules and their actions
         */
        $modules = [
            'country'       => ['view', 'create', 'edit', 'delete', 'restore', 'force_delete'],
            'state'         => ['view', 'create', 'edit', 'delete', 'restore', 'force_delete'],
            'city'          => ['view', 'create', 'edit', 'delete', 'restore', 'force_delete'],

            'user'          => ['view', 'detail', 'create', 'edit', 'delete', 'restore', 'force_delete'],
            'role'          => ['view', 'detail', 'create', 'edit', 'delete'],
            'media'         => ['view', 'delete', 'delete_folder'],
            'setting'       => ['view', 'create'],
        ];

        /**
         * Create all permissions dynamically
         */
        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$module}.{$action}"]);
            }
        }

        /**
         * Create roles
         */
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'group' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'group' => 'user']);

        /**
         * Assign permissions
         * - admin: all permissions
         * - user: only country-related permissions
         */
        $adminPermissions = Permission::all();
        // $userPermissions = Permission::where('name', 'like', 'country.%')->get();

        $adminRole->syncPermissions($adminPermissions);
        // $userRole->syncPermissions($userPermissions);

        // Refresh cache after seeding
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
