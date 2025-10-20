<?php

namespace App\Repositories;

use App\Models\State;

class StateRepository
{
    /**
     * Get all states.
     */
    public function all()
    {
        return State::with('country')->latest()->get();
    }

    /**
     * Paginate states.
     */
    public function filter($filters)
    {
        $query = State::with('country');

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $search = '%' . $filters['search'] . '%';

                $q->where('title', 'like', $search)
                ->orWhereHas('country', function ($countryQuery) use ($search) {
                    $countryQuery->where('title', 'like', $search);
                });
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
     * Find a state by ID.
     */
    public function find($id)
    {
        return State::with('country')->findOrFail($id);
    }

    /**
     * Create a new state.
     */
    public function create(array $data)
    {
        return State::create($data);
    }

    /**
     * Update an existing state.
     */
    public function update($id, array $data)
    {
        $state = $this->find($id);
        $state->update($data);
        return $state;
    }

    /**
     * Delete a state (soft delete).
     */
    public function delete($id)
    {
        $state = $this->find($id);
        return $state->delete();
    }

    /**
     * Restore a soft-deleted state.
     */
    public function restore($id)
    {
        $state = State::withTrashed()->findOrFail($id);
        return $state->restore();
    }

    /**
     * Permanently delete a state.
     */
    public function forceDelete($id)
    {
        $state = State::withTrashed()->findOrFail($id);
        return $state->forceDelete();
    }

    /**
     * Get all active states.
     */
    public function active()
    {
        return State::where('is_active', true)->get();
    }

    /**
     * Get all inactive states.
     */
    public function inactive()
    {
        return State::where('is_active', false)->get();
    }
}
