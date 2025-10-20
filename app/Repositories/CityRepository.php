<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    /**
     * Get all cities.
     */
    public function all()
    {
        return City::with('state')->latest()->get();
    }

    /**
     * Paginate cities.
     */
    public function filter($filters)
    {
        $query = City::with('state');

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $search = '%' . $filters['search'] . '%';

                $q->where('title', 'like', $search)
                ->orWhereHas('state', function ($stateQuery) use ($search) {
                    $stateQuery->where('title', 'like', $search)
                        ->orWhereHas('country', function ($countryQuery) use ($search) {
                            $countryQuery->where('title', 'like', $search);
                        });
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
     * Find a city by ID.
     */
    public function find($id)
    {
        return City::with('state')->findOrFail($id);
    }

    /**
     * Create a new city.
     */
    public function create(array $data)
    {
        return City::create($data);
    }

    /**
     * Update an existing city.
     */
    public function update($id, array $data)
    {
        $city = $this->find($id);
        $city->update($data);
        return $city;
    }

    /**
     * Delete a city (soft delete).
     */
    public function delete($id)
    {
        $city = $this->find($id);
        return $city->delete();
    }

    /**
     * Restore a soft-deleted city.
     */
    public function restore($id)
    {
        $city = City::withTrashed()->findOrFail($id);
        return $city->restore();
    }

    /**
     * Permanently delete a city.
     */
    public function forceDelete($id)
    {
        $city = City::withTrashed()->findOrFail($id);
        return $city->forceDelete();
    }

    /**
     * Get all active cities.
     */
    public function active()
    {
        return City::where('is_active', true)->get();
    }

    /**
     * Get all inactive cities.
     */
    public function inactive()
    {
        return City::where('is_active', false)->get();
    }
}
