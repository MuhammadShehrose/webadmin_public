@extends('web.layouts.app')

@section('title', 'Verify Account')

@section('content')
    <section class="py-5" style="min-height: 100vh; display: flex; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="text-center mb-4 fw-bold">Verify Your Email Address</h2>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    A new verification link has been sent to your email address.
                                </div>
                            @endif

                            <ul>
                                <li>Before proceeding, please check your email for a verification link.</li>
                                <li>If you did not receive the email, click below to request another.</li>
                            </ul>

                            <br>

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Resend Verification Email
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
