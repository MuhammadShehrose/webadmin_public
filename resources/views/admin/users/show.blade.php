@extends('admin.layouts.app')

@section('title', 'User Detail')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">User Detail</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <a class="btn btn-outline-dark" href="{{ route('admin.users.index') }}">
                    <i class="mdi mdi-arrow-left-bold me-2"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12">
            <div class="card box-widget widget-user">
                <div class="widget-user-image mx-auto mt-5"><img alt="User Avatar" class="rounded-circle"
                        src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/admin/images/users/avatar-300.png') }}">
                </div>
                <div class="card-body text-center">
                    <div class="pro-user">
                        <h4 class="pro-user-username mb-2 font-weight-bold">
                            {{ $user->name }}
                        </h4>

                        <p class="mb-1">
                            <strong>Status: </strong> <span class="text-{{$user->is_active ? 'success' : 'danger'}}">{{ $user->status_text }}</span>
                        </p>
                        <p>
                            <strong>Email Verification: </strong> <span class="text-{{$user->email_verified_at ? 'success' : 'danger'}}">{{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</span>
                        </p>

                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="fa fa-rss me-2"></i>
                            Edit Profile
                        </a>
                        @if (!$user->email_verified_at)
                            <a href="{{ route('admin.users.verify', $user->id) }}" class="btn btn-success">
                                <i class="fa fa-check me-2"></i>
                                Verify
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Personal Details</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Role Type </span>
                                    </td>
                                    <td class="">{{ ucfirst($user->role_group) }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Location </span>
                                    </td>
                                    <td class="">N/A</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Languages </span>
                                    </td>
                                    <td class="">N/A</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Email </span>
                                    </td>
                                    <td class="">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Phone </span>
                                    </td>
                                    <td class="">N/A</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Member Since </span>
                                    </td>
                                    <td class="">{{ $user->created_at->format('d-M-Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Account Status </span>
                                    </td>
                                    <td class=""><span class="text-{{$user->is_active ? 'success' : 'danger'}}">{{ $user->status_text }}</span></td>
                                </tr>
                                <tr>
                                    <td class="">
                                        <span class="font-weight-semibold w-50">Email Verification </span>
                                    </td>
                                    <td class=""><span class="text-{{$user->email_verified_at ? 'success' : 'danger'}}">{{ $user->email_verified_at ? 'Verified' : 'Unverified' }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
