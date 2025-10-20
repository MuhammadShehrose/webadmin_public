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
        $brandRole = Role::firstOrCreate(['name' => 'brand', 'group' => 'brand']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'group' => 'user']);

        /**
         * Assign permissions
         * - admin: all permissions
         * - brand: only country-related permissions
         */
        $adminPermissions = Permission::all();
        // $brandPermissions = Permission::where('name', 'like', 'country.%')->get();

        $adminRole->syncPermissions($adminPermissions);
        // $brandRole->syncPermissions($brandPermissions);

        // Refresh cache after seeding
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
