@extends('layouts.app')
@section('title', 'Role Management')
@section('page-title', 'Home')
@section('page-subtitle', 'Role List')
@section('content')

<style>
    thead tr th {
        background-color: #198754 !important;
        color: white !important;
    }
</style>
<div class="ml-auto d-flex">
    <div class="btn-group ms-auto">
        <a class="btn btn-primary" href="{{ route('role.create') }}"><i class="fa fa-plus"></i></a>
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
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Identity')}}</th>
                                    <th class="white-space-nowrap">{{__('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $p)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$p->name}}</td>
                                    <td>{{$p->identity}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route('role.edit',encryptor('encrypt',$p->id))}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('permission.list',encryptor('encrypt',$p->id))}}">
                                            <i class="fa fa-unlock"></i>
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form id="form{{$p->id}}" action="{{route('role.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="8" class="text-center">No Pruduct Found</th>
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