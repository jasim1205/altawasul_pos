@extends('layouts.app')

@section('title', 'Role Management')
@section('page-title', 'Home')
@section('page-subtitle', 'Role Create')

@section('content')
<style>
    .input-group-text {
        background-color: #3A58B3;
        color: white;
        /* width:150px !important; */
    }

    .star {
        color: rgb(248, 62, 62);
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="post" enctype="multipart/form-data" action="{{route('role.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" for="Identity">Identity (only Alpha Character)<i class="text-danger">*</i></span>
                                    <input type="text" id="Identity" pattern="[A-Za-z]+" class="form-control" value="{{ old('Identity')}}" name="Identity">
                                    @if($errors->has('Identity'))
                                        <span class="text-danger"> {{ $errors->first('Identity') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="input-group">
                                    <span class="input-group-text" for="Name">Name</span>
                                    <input type="text" id="Name" class="form-control" value="{{ old('Name')}}" name="Name">
                                    @if($errors->has('Name'))
                                        <span class="text-danger"> {{ $errors->first('Name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
