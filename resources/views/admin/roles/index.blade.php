@extends('admin.layouts.app')

@section('title', 'Roles')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Roles</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @can('role.create')
                    <a class="btn btn-outline-primary" href="{{route('admin.roles.create')}}">
                        <i class="mdi mdi mdi-playlist-check me-2"></i>
                        Create
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">

            <div class="card">
                <div class="card-body">
                    @include('admin.roles.filters')
                    <div class="table-responsive border">
                        <table class="table table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Group</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $role)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                                        </th>
                                        <td class="text-capitalize">{{ $role->name }}</td>
                                        <td class="text-capitalize">{{ $role->group }}</td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :view-url="route('admin.roles.show', $role->id)"
                                                :edit-url="route('admin.roles.edit', $role->id)"
                                                :delete-url="route('admin.roles.destroy', $role->id)"

                                                view-permission="role.detail"
                                                edit-permission="role.edit"
                                                delete-permission="role.delete"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center fw-bold">
                                            No record found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <x-pagination-section :data="$data" />
                </div>
            </div>

        </div>
    </div>
@endsection
