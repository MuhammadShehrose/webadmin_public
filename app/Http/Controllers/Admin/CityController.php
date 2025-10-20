<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Requests\CityRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\StateRepository;

class CityController extends Controller
{
    protected $repo;

    public function __construct(CityRepository $cities)
    {
        $this->repo = $cities;

        $this->middleware('permission:city.view')->only('index');
        $this->middleware('permission:city.create')->only(['create', 'store']);
        $this->middleware('permission:city.edit')->only(['edit', 'update']);
        $this->middleware('permission:city.delete')->only('destroy');
        $this->middleware('permission:city.restore')->only('restore');
        $this->middleware('permission:city.force_delete')->only('forceDelete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->filled('search') ? $request->input('search') : null,
            'trashed' => $request->filled('trashed') ? $request->input('trashed') : null,
            'is_active' => $request->filled('is_active') ? $request->input('is_active') : null,
        ];
        $data = $this->repo->filter($filters, 10);
        return view('admin.cities.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StateRepository $stateRepo, CountryRepository $countryRepo)
    {
        $city = new City();
        $countries = $countryRepo->active();
        // $states = $stateRepo->active();
        $states = [];
        return view('admin.cities.create', compact('city', 'countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('admin.cities.index')->with('success', 'City created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StateRepository $stateRepo, CountryRepository $countryRepo, string $id)
    {
        $city = $this->repo->find($id);
        $countries = $countryRepo->active();
        $states = $stateRepo->active();
        return view('admin.cities.edit', compact('city', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $this->repo->update($id, $request->validated());
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.cities.index')->with('success', 'City deleted!');
    }

    public function forceDelete(string $id)
    {
        $this->repo->forceDelete($id);
        return redirect()->route('admin.cities.index')->with('success', 'City permanently deleted!');
    }

    public function restore(string $id)
    {
        $this->repo->restore($id);
        return redirect()->route('admin.cities.index')->with('success', 'City permanently deleted!');
    }
}
