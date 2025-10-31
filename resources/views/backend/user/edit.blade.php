@extends('layouts.app')
@section('title', 'User')
@section('page-title', 'Home')
@section('page-subtitle', 'Edit User')
@section('content')
    <style>
        .input-group-text {
            background-color: #3A58B3;
            color: white;
            width:150px !important;
        }

        .star {
            color: rgb(248, 62, 62);
        }
    </style>
    <!--breadcrumb-->
    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('user.index') }}"><i class="fa fa-list"></i></a>
        </div>
    </div>
    <hr>
    <div id="stepper1" class="bs-stepper">
        <div class="card">
            <div class="card-body">
                <div class="bs-stepper-content">
                    <form  action="{{ route('user.update', encryptor('encrypt', $user->id)) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="uptoken" value="{{ encryptor('encrypt', $user->id) }}">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Name <span
                                                class="star">*</span></span>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}"
                                            placeholder="Enter a user name" aria-label="Username"
                                            aria-describedby="basic-addon1">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Email</span>
                                        <input type="email;" name="email" value="{{old('email',$user->email)}}" class="form-control" id="name"
                                            placeholder="Enter a Email"  required/>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Phone</span>
                                        <input type="text" name="contact_no" value="{{ old('contact_no', $user->contact_no) }}" class="form-control" id="name"
                                            placeholder="Enter a Phone number" />
                                        @error('contact_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Password</span>
                                        <input type="password" name="password" class="form-control" id="name"
                                            placeholder="Enter a Password" />
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" >Status</span>
                                        <select id="status" class="form-control" name="status" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                            <option value="1" @if (old('status', $user->status) == 1) selected @endif>Active
                                            </option>
                                            <option value="0" @if (old('status', $user->status) == 0) selected @endif>Inactive
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger"> {{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end stepper one-->
@endsection