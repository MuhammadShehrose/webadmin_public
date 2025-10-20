<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $users)
    {
        $this->repo = $users;

        $this->middleware('permission:user.view')->only('index');
        $this->middleware('permission:user.create')->only(['create', 'store']);
        $this->middleware('permission:user.edit')->only(['edit', 'update']);
        $this->middleware('permission:user.delete')->only('destroy');
        $this->middleware('permission:user.restore')->only('restore');
        $this->middleware('permission:user.force_delete')->only('forceDelete');
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
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleRepository $roleRepo)
    {
        $user = new User();
        $roles = $roleRepo->all();
        return view('admin.users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = file_upload($request->file('image'), 'users', 'public', 300, 300);
            }
            $this->repo->create($data);
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User created successfully!');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the user. Please try again.');
        }
    }

    /**
     * Show the details of the specified resource.
     */
    public function show($id)
    {
        $user = $this->repo->find($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleRepository $roleRepo, string $id)
    {
        $user = $this->repo->find($id);
        $roles = $roleRepo->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $user = $this->repo->find($id);

            if ($request->hasFile('image')) {
                // 1️⃣ Remove the old image first
                if ($user->image) {
                    file_remove($user->image, 'public');
                }

                $data['image'] = file_upload($request->file('image'), 'users', 'public', 300, 300);
            }
            $this->repo->update($id, $data);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User updated successfully!');

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while updating the user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted!');
    }

    public function forceDelete(string $id)
    {
        $this->repo->forceDelete($id);
        return redirect()->route('admin.users.index')->with('success', 'User permanently deleted!');
    }

    public function restore(string $id)
    {
        $this->repo->restore($id);
        return redirect()->route('admin.users.index')->with('success', 'User permanently deleted!');
    }

    public function verify($id)
    {
        $this->repo->verify($id);
        return redirect()->back()->with('success', 'User verified successfully!');
    }
}
