@extends('admin.layouts.app')

@section('title', 'Countries')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Countries</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                @can('country.create')
                    <a class="btn btn-outline-primary" href="{{route('admin.countries.create')}}">
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
                    @include('admin.countries.filters')
                    <div class="table-responsive border">
                        <table class="table table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $country)
                                    <tr>
                                        <th>
                                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                                        </th>
                                        <td>{{ $country->title }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-gradient-{{ $country->is_active ? 'success' : 'danger' }}">
                                                {{$country->status_text}}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <x-table-actions
                                                :edit-url="$country->trashed() ? null : route('admin.countries.edit', $country->id)"
                                                :delete-url="$country->trashed() ? null : route('admin.countries.destroy', $country->id)"
                                                :restore-url="$country->trashed() ? route('admin.countries.restore', $country->id) : null"
                                                :forceDelete-url="$country->trashed() ? route('admin.countries.forceDelete', $country->id) : null"

                                                edit-permission="{{ $country->trashed() ? null : 'country.edit' }}"
                                                delete-permission="{{ $country->trashed() ? null : 'country.delete' }}"
                                                restore-permission="{{ $country->trashed() ? 'country.restore' : null }}"
                                                forceDelete-permission="{{ $country->trashed() ? 'country.force_delete' : null }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center fw-bold">
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
