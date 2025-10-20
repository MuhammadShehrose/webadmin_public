<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Requests\StateRequest;
use App\Http\Controllers\Controller;
use App\Repositories\StateRepository;
use App\Repositories\CountryRepository;

class StateController extends Controller
{
    protected $repo;

    public function __construct(StateRepository $states)
    {
        $this->repo = $states;

        $this->middleware('permission:state.view')->only('index');
        $this->middleware('permission:state.create')->only(['create', 'store']);
        $this->middleware('permission:state.edit')->only(['edit', 'update']);
        $this->middleware('permission:state.delete')->only('destroy');
        $this->middleware('permission:state.restore')->only('restore');
        $this->middleware('permission:state.force_delete')->only('forceDelete');
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
        return view('admin.states.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CountryRepository $countryRepo)
    {
        $state = new State();
        $countries = $countryRepo->active();
        return view('admin.states.create', compact('state', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('admin.states.index')->with('success', 'State created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CountryRepository $countryRepo, string $id)
    {
        $state = $this->repo->find($id);
        $countries = $countryRepo->active();
        return view('admin.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, string $id)
    {
        $this->repo->update($id, $request->validated());
        return redirect()->route('admin.states.index')->with('success', 'State updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.states.index')->with('success', 'State deleted!');
    }

    public function forceDelete(string $id)
    {
        $this->repo->forceDelete($id);
        return redirect()->route('admin.states.index')->with('success', 'State permanently deleted!');
    }

    public function restore(string $id)
    {
        $this->repo->restore($id);
        return redirect()->route('admin.states.index')->with('success', 'State permanently deleted!');
    }

    public function getByCountry($countryId)
    {
        $states = State::where('country_id', $countryId)->active()->get(['id', 'title']);
        return response()->json($states);
    }
}
