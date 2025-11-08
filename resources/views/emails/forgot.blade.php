@extends('layouts.appAuth')

@section('title', 'Login')

@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">

                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-5">

                            <p>Hello,</p>
                            <p>You requested to reset your password.</p>
                            <p>Click the link below to reset it:</p>
                            <p>
                                <a href="{{ $resetLink }}" target="_blank">{{ $resetLink }}</a>
                            </p>
                            <p>If you didn’t request a password reset, please ignore this email.</p>

                        </div>
                    </div>
                </div>
    </section>
@endsection
