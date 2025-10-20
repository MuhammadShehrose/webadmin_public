@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0 text-primary"><span class="text-muted">Settings / </span>SMTP</h4>
        </div>
    </div>

    <div class="row">

        <div class="col-md-5 col-lg-3">
            @include('admin.settings.includes.side_links')
        </div>

        <div class="col-md-7 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">SMTP Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label for="mail_from_name">Mail From Name </label>
                                <input type="text" name="mail_from_name" id="mail_from_name"
                                    value="{{ old('mail_host', $settings['mail_from_name']) }}"
                                    class="form-control @error('mail_from_name') is-invalid @enderror">
                                @error('mail_from_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_from_address">Mail From Address </label>
                                <input type="text" name="mail_from_address" id="mail_from_address"
                                    value="{{ old('mail_host', $settings['mail_from_address']) }}"
                                    class="form-control @error('mail_from_address') is-invalid @enderror">
                                @error('mail_from_address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_host">Mail Host </label>
                                <input type="text" name="mail_host" id="mail_host"
                                    value="{{ old('mail_host', $settings['mail_host']) }}"
                                    class="form-control @error('mail_host') is-invalid @enderror">
                                @error('mail_host')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_port">Mail Port </label>
                                <input type="text" name="mail_port" id="mail_port"
                                    value="{{ old('mail_host', $settings['mail_port']) }}"
                                    class="form-control @error('mail_port') is-invalid @enderror">
                                @error('mail_port')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_username">Mail Username </label>
                                <input type="text" name="mail_username" id="mail_username"
                                    value="{{ old('mail_host', $settings['mail_username']) }}"
                                    class="form-control @error('mail_username') is-invalid @enderror">
                                @error('mail_username')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_password">Mail Password </label>
                                <input type="text" name="mail_password" id="mail_password"
                                    value="{{ old('mail_host', $settings['mail_password']) }}"
                                    class="form-control @error('mail_password') is-invalid @enderror">
                                @error('mail_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_mailer">Mail Mailer </label>
                                <input type="text" name="mail_mailer" id="mail_mailer"
                                    value="{{ old('mail_mailer', $settings['mail_mailer']) }}"
                                    class="form-control @error('mail_mailer') is-invalid @enderror">
                                @error('mail_mailer')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label for="mail_encryption">Mail Encryption </label>
                                <input type="text" name="mail_encryption" id="mail_encryption"
                                    value="{{ old('mail_host', $settings['mail_encryption']) }}"
                                    class="form-control @error('mail_encryption') is-invalid @enderror">
                                @error('mail_encryption')
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
