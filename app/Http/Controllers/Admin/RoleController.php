<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleGroup;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    protected $repo;

    public function __construct(RoleRepository $roles)
    {
        $this->repo = $roles;

        $this->middleware('permission:role.view')->only('index');
        $this->middleware('permission:role.detail')->only('show');
        $this->middleware('permission:role.create')->only(['create', 'store']);
        $this->middleware('permission:role.edit')->only(['edit', 'update']);
        $this->middleware('permission:role.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->filled('search') ? $request->input('search') : null,
        ];
        $data = $this->repo->filter($filters, 10);
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = new Role();
        $roleGroups = RoleGroup::options();
        $groupedPermissions = $this->repo->getGroupedPermissions();
        return view('admin.roles.create', compact('role', 'roleGroups', 'groupedPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->repo->create($request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->repo->find($id);
        $groupedPermissions = $this->repo->getGroupedPermissionsForRole($role);
        return view('admin.roles.show', compact('role', 'groupedPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->repo->find($id);
        $roleGroups = RoleGroup::options();
        $groupedPermissions = $this->repo->getGroupedPermissions();
        return view('admin.roles.edit', compact('role', 'roleGroups', 'groupedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $this->repo->update($id, $request->validated());
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted!');
    }
}
