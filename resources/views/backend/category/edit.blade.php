@extends('layouts.app')
@section('title',trans('Category'))
@section('page',trans('Edit'))
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Category</h3>
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
                    <form action="{{route('category.update',encryptor('encrypt',$category->id))}}" method="post">
                        @csrf
                        @method('Patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <select name="company_id" id="" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach ($company as $value)
                                            <option value="{{ $value->id }}" {{ old('company_id',$category->company_id)==$value->id?"selected":""}}>{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="company_id" class="form-control" id="name" placeholder="Enter a company name"/> --}}
                                </div>
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="category_name" value="{{ old('category_name',$category->category_name) }}" class="form-control" id="name" placeholder="Enter a Category name"/>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection