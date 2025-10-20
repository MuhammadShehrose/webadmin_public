@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary"><span class="text-muted">Settings / </span>General</h4>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5 col-lg-3">
            @include('admin.settings.includes.side_links')
        </div>

        <div class="col-md-7 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">General Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="website_name">Website Name</label>
                                <input type="text" name="website_name" id="website_name"
                                    value="{{ old('website_name', $settings['website_name']) }}"
                                    class="form-control @error('website_name') is-invalid @enderror" required>
                                @error('website_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="pagination_limit">Pagination Limit</label>
                                <input type="number" name="pagination_limit" id="pagination_limit"
                                    value="{{ old('pagination_limit', $settings['pagination_limit']) }}"
                                    class="form-control @error('pagination_limit') is-invalid @enderror" required>
                                @error('pagination_limit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="desktop_logo">Desktop Logo <span class="text-muted">(240x68 recommended)</span></label>
                                <input type="file" name="desktop_logo" id="desktop_logo"
                                    class="form-control @error('desktop_logo') is-invalid @enderror">
                                @if (setting('desktop_logo'))
                                    <img src="{{ asset('storage/' . setting('desktop_logo')) }}" class="mt-1"
                                        alt="desktop_logo">
                                @endif
                                @error('desktop_logo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="mobile_logo">Mobile Logo <span class="text-muted">(64x68 recommended)</span></label>
                                <input type="file" name="mobile_logo" id="mobile_logo"
                                    class="form-control @error('mobile_logo') is-invalid @enderror">
                                @if (setting('mobile_logo'))
                                    <img src="{{ asset('storage/' . setting('mobile_logo')) }}" class="mt-1"
                                        alt="mobile_logo">
                                @endif
                                @error('mobile_logo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="favicon">Favicon <span class="text-muted">(48x48 recommended)</span></label>
                                <input type="file" name="favicon" id="favicon"
                                    class="form-control @error('favicon') is-invalid @enderror">
                                @if (setting('favicon'))
                                    <img src="{{ asset('storage/' . setting('favicon')) }}" alt="favicon" class="mt-1">
                                @endif
                                @error('favicon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 mt-1">
                                <button class="btn btn-success px-4" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
