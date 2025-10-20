<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Get all users.
     */
    public function all()
    {
        return User::latest()->get();
    }

    /**
     * Paginate users.
     */
    public function filter($filters)
    {
        $query = User::query();

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['trashed'])) {
            if ($filters['trashed']) {
                $query->onlyTrashed();
            } else {
                $query->withTrashed();
            }
        }

        return $query->latest()->paginate(setting('pagination_limit', 25));
    }

    /**
     * Find a user by ID.
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Create a new user.
     */
    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            // ✅ Hash password if present
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            // ✅ Automatically verify email
            $data['email_verified_at'] = now();

            // ✅ Create user
            $user = User::create($data);

            // ✅ Sync roles if provided
            if (!empty($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            DB::commit();
            return $user;

        } catch (\Exception $e) {
            DB::rollBack();
            // Optionally, throw a more user-friendly exception
            throw new \RuntimeException('Failed to create user. Please try again.');
        }
    }

    /**
     * Update an existing user.
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = $this->find($id);

            // If password field is empty (optional on update), remove it
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            // Update core user fields
            $user->update($data);

            // Sync roles if provided
            if (isset($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            return $user;
        });
    }

    /**
     * Delete a user (soft delete).
     */
    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }

    /**
     * Restore a soft-deleted user.
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return $user->restore();
    }

    /**
     * Verify a unverified user.
     */
    public function verify($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();
        return $user;
    }

    /**
     * Permanently delete a user.
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return $user->forceDelete();
    }

    /**
     * Get all active users.
     */
    public function active()
    {
        return User::where('is_active', true)->get();
    }

    /**
     * Get all inactive users.
     */
    public function inactive()
    {
        return User::where('is_active', false)->get();
    }
}
