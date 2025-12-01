@extends('layouts.app')
@section('title', 'Customer')
@section('page-title', 'Home')
@section('page-subtitle', 'Customer List')
@section('content')
<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }
</style>
<section class="section">
    <div class="row">
        <div class="col-sm-12 d-flex">
            {{-- <div class="btn-group">
            <a class="btn btn-outline-primary" href="{{ route('product.reportForm') }}">Report</a>
        </div> --}}
            <div class="ms-auto d-flex" style="float: right">
                {{-- <form action="{{ route('product.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search by name, code, or origin" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-success">Search</button>
                    <a href="{{ route('product.index') }}" class="btn btn-outline-warning">Reset</a>
                </div>
            </form> --}}
                <div class="btn-group mx-1">
                    <a class="btn btn-primary" href="{{ route('customer.create') }}"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customer as $value)
                                    <tr>
                                        <td>{{ __(++$loop->index) }}</td>
                                        <td>{{ __($value->customer_name) }}</td>
                                        <td>{{ __($value->email) }}</td>
                                        <td>{{ __($value->contact_no) }}</td>
                                        <td>{{ __($value->address) }}</td>
                                        
                                        <td class="white-space-nowrap">
                                            <div class="d-flex">
                                                <a href="{{route('customer.edit',encryptor('encrypt',$value->id))}}" class="btn btn-warning text-white">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                {{-- <form action="{{route('customer.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none" onclick="return confirm('Are you sure to delete this customer?')" class="btn btn-danger ms-2">
                                                            <span class=""><i class="fa fa-trash"></i></span>
                                                        </button>
                                                    </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center fw-bolder">Company No found</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection