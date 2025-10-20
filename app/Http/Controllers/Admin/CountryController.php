<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Repositories\CountryRepository;

class CountryController extends Controller
{
    protected $repo;

    public function __construct(CountryRepository $countries)
    {
        $this->repo = $countries;

        $this->middleware('permission:country.view')->only('index');
        $this->middleware('permission:country.create')->only(['create', 'store']);
        $this->middleware('permission:country.edit')->only(['edit', 'update']);
        $this->middleware('permission:country.delete')->only('destroy');
        $this->middleware('permission:country.restore')->only('restore');
        $this->middleware('permission:country.force_delete')->only('forceDelete');
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
        return view('admin.countries.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = new Country();
        return view('admin.countries.create', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = $this->repo->find($id);
        return view('admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        $this->repo->update($id, $request->validated());
        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.countries.index')->with('success', 'Country deleted!');
    }

    public function forceDelete(string $id)
    {
        $this->repo->forceDelete($id);
        return redirect()->route('admin.countries.index')->with('success', 'Country permanently deleted!');
    }

    public function restore(string $id)
    {
        $this->repo->restore($id);
        return redirect()->route('admin.countries.index')->with('success', 'Country permanently deleted!');
    }
}
