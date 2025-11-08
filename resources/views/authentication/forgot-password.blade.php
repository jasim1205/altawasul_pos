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
                        <h3>Forgot Password</h3>

                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
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
