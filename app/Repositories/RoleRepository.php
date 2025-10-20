<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepository
{
    /**
     * Get all countries.
     */
    public function all()
    {
        return Role::with('permissions')->latest()->get();
    }

    /**
     * Paginate countries.
     */
    public function filter($filters)
    {
        $query = Role::with('permissions');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        return $query->latest()->paginate(setting('pagination_limit', 25));
    }

    /**
     * Find a role by ID.
     */
    public function find($id)
    {
        return Role::with('permissions')->findOrFail($id);
    }

    /**
     * Create a new role.
     */
    public function create(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
            'group' => $data['group']
        ]);
        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
    }

    /**
     * Update an existing role.
     */
    public function update($id, array $data)
    {
        $role = $this->find($id);

        $role->update([
            'name' => $data['name'],
            'group' => $data['group']
        ]);

        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        } else {
            $role->syncPermissions([]); // Remove all permissions if none selected
        }

        return $role;
    }

    /**
     * Delete a role (soft delete).
     */
    public function delete($id)
    {
        $role = $this->find($id);
        return $role->delete();
    }

    public function getGroupedPermissions()
    {
        return Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
    }

    public function getGroupedPermissionsForRole($role)
    {
        return $role->permissions->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });
    }
}
