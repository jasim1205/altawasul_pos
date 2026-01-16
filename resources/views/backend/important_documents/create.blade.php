@extends('layouts.app')
@section('title', 'Document')
@section('page-title', 'Home')
@section('page-subtitle', 'Create Document')
@section('content')
<style>
    .input-group-text {
        background-color: #3A58B3;
        color: white;
        width: 150px;
    }

    .star {
        color: rgb(248, 62, 62);
    }
</style>
<!--breadcrumb-->
<div class="ml-auto d-flex">
    <div class="btn-group ms-auto">
        <a class="btn btn-primary" href="{{ route('document.index') }}"><i class="fa fa-list"></i></a>
    </div>
</div>
<hr>
<div id="stepper1" class="bs-stepper">
    <div class="card">
        <div class="card-body">
            <div class="bs-stepper-content">
                @if($formType == 'edit')
                <form action="{{route('document.update',$document->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $document->id }}" name="id">
                @else
                    <form action="{{route('document.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                @endif
                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Document Name <span
                                            class="star">*</span></span>
                                    <input type="text" class="form-control" name="name" value="{{ $formType == 'edit' ? $document->name : '' }}"
                                        placeholder="Enter a document name" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Expiry Date</span>
                                    <input type="date" name="date" value="{{ $formType == 'edit' ? $document->date : '' }}" class="form-control" id="name"
                                        placeholder="Enter a Document date" />
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Upload File</span>
                                    <input type="file" name="file" class="form-control" id="name"
                                        placeholder="Upload Document file" />
                                    @error('file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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