@extends('admin.layouts.app')

@section('title', 'Cities')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Cities</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @can('city.create')
                    <a class="btn btn-outline-primary" href="{{route('admin.cities.create')}}">
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
                    @include('admin.cities.filters')
                    <div class="table-responsive border">
                        <table class="table table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $city)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                                        </th>
                                        <td>{{ $city->title }}</td>
                                        <td>{{ $city->state->title ?? '' }}</td>
                                        <td>{{ $city->state->country->title ?? '' }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-gradient-{{ $city->is_active ? 'success' : 'danger' }}">
                                                {{$city->status_text}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :edit-url="$city->trashed() ? null : route('admin.cities.edit', $city->id)"
                                                :delete-url="$city->trashed() ? null : route('admin.cities.destroy', $city->id)"
                                                :restore-url="$city->trashed() ? route('admin.cities.restore', $city->id) : null"
                                                :forceDelete-url="$city->trashed() ? route('admin.cities.forceDelete', $city->id) : null"

                                                edit-permission="{{ $city->trashed() ? null : 'city.edit' }}"
                                                delete-permission="{{ $city->trashed() ? null : 'city.delete' }}"
                                                restore-permission="{{ $city->trashed() ? 'city.restore' : null }}"
                                                forceDelete-permission="{{ $city->trashed() ? 'city.force_delete' : null }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center fw-bold">
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
