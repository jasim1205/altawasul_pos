@extends('layouts.appAuth')

@section('title', 'Login')

@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">

                            <h3>Reset Password</h3>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-3">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-success">Reset Password</button>
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
