@extends('layouts.appAuth')
@section('title','Login')
@section('content')
<div class="col-lg-12 col-12">
    <div id="auth-left">
    <div class="card w-50 mx-auto">
        <form action="{{route('login.check')}}" method="POST">
        @csrf
        <a href="index.html"
            ><img src="{{asset('public/assets/compiled/svg/logo.svg')}}" class="w-25" alt="Logo"
        /></a>
        <h1 class="auth-title text-center">Login.</h1>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" />
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input
            type="password" name="password"
            class="form-control form-control-xl"
            placeholder="Password"
            />
            <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
            <input
            class="form-check-input me-2"
            type="checkbox"
            value=""
            id="flexCheckDefault"
            />
            <label
            class="form-check-label text-gray-600"
            for="flexCheckDefault"
            >
            Keep me logged in
            </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
            Log in
        </button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">
            Don't have an account?
            <a href="auth-register.html" class="font-bold">Sign up</a>.
        </p>
        <p>
            <a class="font-bold" href="auth-forgot-password.html"
            >Forgot password?</a
            >.
        </p>
        </div>
    </div>
    
    </div>
</div>

       
@endsection