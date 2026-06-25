@extends('layouts.app')
@section('title', 'Document')
@section('page-title', 'Home')
@section('page-subtitle', 'Document List')
@section('content')
<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }

    .document-preview {
        max-width: 80px;
        max-height: 60px;
        display: block;
        margin-bottom: 4px;
    }
</style>
<section class="section">
    <div class="row">
        <div class="col-sm-12 d-flex">
            
            <div class="ms-auto d-flex" style="float: right">
                
                <form action="{{ route('document.user.pdf') }}" method="GET" target="_blank" class="d-flex mx-1">
                    <select name="user_id" id="document_user_id" class="form-control">
                        <option value="">Select User</option>
                        @foreach($user as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="document_print_btn" class="btn btn-danger ms-1" disabled>
                        <i class="fa fa-print"></i>
                    </button>
                </form>
                <div class="btn-group mx-1">
                    <a class="btn btn-primary" href="{{ route('document.create') }}"><i class="fa fa-plus"></i></a>
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
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Expire Date</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($document as $value)
                                    <tr>
                                        <td>{{ __(++$loop->index) }}</td>
                                        <td>{{ __($value->user?->name) }}</td>
                                        <td>{{ __($value->name) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
                                        <td>
                                            {{-- {{dd($value->file)}} --}}
                                            @php
                                                $extension = strtolower(pathinfo($value->file, PATHINFO_EXTENSION));
                                                $fileUrl = url('public/uploads/documents/' . $value->file);
                                            @endphp

                                            @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                                                <a href="{{ $fileUrl }}" target="_blank">
                                                    <img src="{{ $fileUrl }}" alt="{{ $value->file }}" class="document-preview">
                                                </a>
                                            @endif
                                            <a href="{{ $fileUrl }}" target="_blank">{{ __($value->file) }}</a>
                                        </td>
                                        
                                        <td class="white-space-nowrap">
                                            <div class="d-flex">
                                                <a href="{{route('document.edit',$value->id)}}" class="btn btn-warning text-white">
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
                                        <td colspan="6" class="text-center fw-bolder">Document No found</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userSelect = document.getElementById('document_user_id');
        const printButton = document.getElementById('document_print_btn');

        userSelect.addEventListener('change', function () {
            printButton.disabled = !this.value;
        });
    });
</script>
@endsection
