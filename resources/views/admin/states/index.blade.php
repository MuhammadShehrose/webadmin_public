@extends('admin.layouts.app')

@section('title', 'States')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">States</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @can('state.create')
                    <a class="btn btn-outline-primary" href="{{route('admin.states.create')}}">
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
                    @include('admin.states.filters')
                    <div class="table-responsive border">
                        <table class="table table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Country</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $state)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                                        </th>
                                        <td>{{ $state->title }}</td>
                                        <td>{{ $state->country->title ?? '' }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-gradient-{{ $state->is_active ? 'success' : 'danger' }}">
                                                {{$state->status_text}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :edit-url="$state->trashed() ? null : route('admin.states.edit', $state->id)"
                                                :delete-url="$state->trashed() ? null : route('admin.states.destroy', $state->id)"
                                                :restore-url="$state->trashed() ? route('admin.states.restore', $state->id) : null"
                                                :forceDelete-url="$state->trashed() ? route('admin.states.forceDelete', $state->id) : null"

                                                edit-permission="{{ $state->trashed() ? null : 'state.edit' }}"
                                                delete-permission="{{ $state->trashed() ? null : 'state.delete' }}"
                                                restore-permission="{{ $state->trashed() ? 'state.restore' : null }}"
                                                forceDelete-permission="{{ $state->trashed() ? 'state.force_delete' : null }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center fw-bold">
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
