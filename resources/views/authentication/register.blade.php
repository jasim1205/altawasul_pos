@extends('layouts.appAuth')

@section('title', 'Register')

@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-5">

                        <!-- Logo + Brand -->
                        <div class="text-center mb-4">
                            <a href="{{ url('/') }}" class="d-inline-flex align-items-center text-decoration-none">
                                <img src="{{ asset('public/assets/img/logo.png') }}" alt="ALTAWASUL Logo"
                                    class="me-2" style="height: 50px;">
                                <h4 class="fw-bold text-primary m-0">ALTAWASUL</h4>
                            </a>
                            <p class="mt-2 text-muted">Create your account to get started.</p>
                        </div>

                        <!-- Registration Form -->
                        <form action="{{ route('register.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="FullName" class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 @error('FullName') is-invalid @enderror"
                                           id="FullName" name="FullName" placeholder="Enter your full name"
                                           value="{{ old('FullName') }}" required>
                                </div>
                                @error('FullName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="EmailAddress" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0 @error('EmailAddress') is-invalid @enderror"
                                           id="EmailAddress" name="EmailAddress" placeholder="Enter your email"
                                           value="{{ old('EmailAddress') }}" required>
                                </div>
                                @error('EmailAddress')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contact_no" class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-telephone"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 @error('contact_no') is-invalid @enderror"
                                           id="contact_no" name="contact_no" placeholder="+123456789"
                                           value="{{ old('contact_no') }}" required>
                                </div>
                                @error('contact_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror"
                                           id="password" name="password" placeholder="Enter password" required>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0"
                                           id="password_confirmation" name="password_confirmation"
                                           placeholder="Confirm password" required>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 fw-semibold py-2">
                                <i class="bi bi-person-plus me-1"></i> Register
                            </button>

                            <p class="text-center mt-4 mb-0 small">
                                Already have an account?
                                <a href="{{ route('login') }}" class="fw-semibold text-decoration-none text-primary">
                                    Login here
                                </a>
                            </p>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted small mt-4 mb-0">
                    &copy; {{ date('Y') }} <strong>ALTAWASUL</strong>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
