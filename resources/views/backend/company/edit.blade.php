@extends('layouts.app')
@section('title',trans('Company'))
@section('page',trans('List'))
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Company</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit
                </li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('company.update',encryptor('encrypt',$company->id))}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <input type="text" name="company_name" value="{{ old('company_name',$company->company_name) }}" class="form-control" id="name" placeholder="Enter a company name"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Company Email</label>
                                    <input type="text" name="email" value="{{ old('email',$company->email) }}" class="form-control" id="name" placeholder="Enter a company name"/>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="form-group">
                                    <label for="name">Company Phone</label>
                                    <input type="text" name="contact_no" value="{{ old('contact_no',$company->contact_no) }}" class="form-control" id="name" placeholder="Enter a company name"/>
                                </div>
                                <div class="form-group">
                                    <label for="name">Address</label>
                                    <input type="text" name="address" value="{{ old('address',$company->address) }}" class="form-control" id="name" placeholder="Enter a company name"/>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection