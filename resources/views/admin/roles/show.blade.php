@extends('admin.layouts.app')

@section('title', 'Role Detail')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Role Detail</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <a class="btn btn-outline-dark" href="{{ route('admin.roles.index') }}">
                    <i class="mdi mdi-arrow-left-bold me-2"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h4 class="mb-5">Role: <strong>{{ $role->name }}</strong></h4>
                    <h5 class="mb-5">Group: <strong>{{ ucfirst($role->group) }}</strong></h4>

                    @foreach ($groupedPermissions as $group => $permissions)
                        <div class="card mb-3 shadow-sm border">
                            <div class="card-header d-flex justify-content-between align-items-center bg-light">
                                <span class="font-weight-bold text-capitalize">
                                    {{ ucwords(str_replace('_', ' ', $group)) }} Permissions
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="perm-{{ $permission->id }}" checked disabled>
                                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                    {{ ucwords(str_replace(['_', $group . '.'], [' ', ''], $permission->name)) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if ($role->permissions->isEmpty())
                        <div class="alert alert-warning">No permissions assigned to this role.</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
