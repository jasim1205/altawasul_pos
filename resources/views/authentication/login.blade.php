@extends('layouts.appAuth')

@section('title', 'Login')

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
                            <p class="mt-2 text-muted">Welcome back! Please sign in to your account.</p>
                        </div>

                        <!-- Login Form -->
                        <form action="{{ route('login.check') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="yourEmail" class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="username" id="yourEmail"
                                        class="form-control border-start-0 @error('username') is-invalid @enderror"
                                        placeholder="Enter your email" required>
                                    <div class="invalid-feedback">Please enter your email.</div>
                                </div>
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="yourPassword" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text  border-end-0">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" id="yourPassword"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        placeholder="Enter your password" required>
                                    <div class="invalid-feedback">Please enter your password.</div>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="d-flex justify-content-end mt-1">
                                    <a href="{{ route('password.request') }}" class="small text-decoration-none text-primary">Forgot password?</a>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                <label class="form-check-label small" for="rememberMe">Remember me</label>
                            </div>

                            <button class="btn btn-primary w-100 fw-semibold py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </button>

                            <p class="text-center mt-4 mb-0 small">
                                Don’t have an account?
                                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none text-primary">
                                    Create one
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
