<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    /**
     * Get all countries.
     */
    public function all()
    {
        return Country::latest()->get();
    }

    /**
     * Paginate countries.
     */
    public function filter($filters)
    {
        $query = Country::query();

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%');
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
     * Find a country by ID.
     */
    public function find($id)
    {
        return Country::findOrFail($id);
    }

    /**
     * Create a new country.
     */
    public function create(array $data)
    {
        return Country::create($data);
    }

    /**
     * Update an existing country.
     */
    public function update($id, array $data)
    {
        $country = $this->find($id);
        $country->update($data);
        return $country;
    }

    /**
     * Delete a country (soft delete).
     */
    public function delete($id)
    {
        $country = $this->find($id);
        return $country->delete();
    }

    /**
     * Restore a soft-deleted country.
     */
    public function restore($id)
    {
        $country = Country::withTrashed()->findOrFail($id);
        return $country->restore();
    }

    /**
     * Permanently delete a country.
     */
    public function forceDelete($id)
    {
        $country = Country::withTrashed()->findOrFail($id);
        return $country->forceDelete();
    }

    /**
     * Get all active countries.
     */
    public function active()
    {
        return Country::where('is_active', true)->get();
    }

    /**
     * Get all inactive countries.
     */
    public function inactive()
    {
        return Country::where('is_active', false)->get();
    }
}
