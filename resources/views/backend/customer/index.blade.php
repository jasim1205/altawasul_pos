@extends('layouts.app')
@section('title',trans('Customer'))
@section('page',trans('List'))
@section('content')
<!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tables</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Customer List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a class="btn btn-primary" href="{{route('customer.create')}}"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    {{-- <h6 class="mb-0 text-uppercase">Company</h6> --}}
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                                        <a href="{{route('customer.edit',encryptor('encrypt',$value->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('customer.destroy',encryptor('encrypt',$value->id))}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="border:none">
                                                    <span class=""><i class="fa fa-trash text-danger"></i></span>
                                                </button>
                                            </form>
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
    

@endsection