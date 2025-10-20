@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Users</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @can('user.create')
                    <a class="btn btn-outline-primary" href="{{route('admin.users.create')}}">
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
                    @include('admin.users.filters')
                    <div class="table-responsive border">
                        <table class="table table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th class="text-center">Verification</th>
                                    <th class="text-center">Joined At</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $user)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                                        </td>
                                        <td>
                                            <img class="avatat avatar-md brround"
                                                src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/admin/images/users/avatar-300.png') }}"
                                                alt="img">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-gradient-{{ $user->email_verified_at ? 'success' : 'danger' }}">
                                                {{$user->email_verified_at ? 'Verified' : 'Unverified'}}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $user->created_at->format('d-M-Y h:i A') }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-gradient-{{ $user->is_active ? 'success' : 'danger' }}">
                                                {{$user->status_text}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :view-url="$user->trashed() ? null : route('admin.users.show', $user->id)"
                                                :edit-url="$user->trashed() ? null : route('admin.users.edit', $user->id)"
                                                :delete-url="$user->trashed() ? null : route('admin.users.destroy', $user->id)"
                                                :restore-url="$user->trashed() ? route('admin.users.restore', $user->id) : null"
                                                :forceDelete-url="$user->trashed() ? route('admin.users.forceDelete', $user->id) : null"

                                                view-permission="{{ $user->trashed() ? null : 'user.detail' }}"
                                                edit-permission="{{ $user->trashed() ? null : 'user.edit' }}"
                                                delete-permission="{{ $user->trashed() ? null : 'user.delete' }}"
                                                restore-permission="{{ $user->trashed() ? 'user.restore' : null }}"
                                                forceDelete-permission="{{ $user->trashed() ? 'user.force_delete' : null }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center fw-bold">
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
