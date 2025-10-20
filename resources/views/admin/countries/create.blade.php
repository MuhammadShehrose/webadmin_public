@extends('admin.layouts.app')

@section('title', 'Add Country')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary">Add Country</h4>
        </div>
        <div class="page-rightheader">
            <div class="btn-list">
                <a class="btn btn-outline-dark" href="{{route('admin.countries.index')}}">
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
                    <form action="{{ route('admin.countries.store') }}" method="POST">
                        @csrf
                        @include('admin.countries.form')
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
