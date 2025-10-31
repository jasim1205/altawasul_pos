@extends('layouts.app')
@section('title', 'User Management')
@section('page-title', 'Home')
@section('page-subtitle', 'User List')
@section('content')
    <style>
        thead tr th {
            background-color: #198754 !important;
            color: white !important;
        }
    </style>
    <div class="ml-auto d-flex">
        <div class="btn-group ms-auto">
            <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <hr>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered" style="width:100%">
                                <thead class="">
                                    <tr class="bg-success text-white">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user as $value)
                                        <tr>
                                            <td>{{ __($value->name) }}</td>
                                            <td>{{ __($value->email) }}</td>
                                            <td>{{ __($value->contact_no) }}</td>
                                            <td>{{ __($value->role->name) }}</td>
                                            <td class="white-space-nowrap">
                                                <div class="d-flex">
                                                    <a href="{{ route('user.edit', encryptor('encrypt', $value->id)) }}"
                                                        class="btn btn-warning text-white" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('user.destroy', encryptor('encrypt', $value->id)) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="border:none"
                                                            onclick="return confirm('Are you sure to delete?')"
                                                            title="Delete" class="btn btn-danger ms-2">
                                                            <span class=""><i class="fa fa-trash"></i></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center fw-bolder">Product No found</td>
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
