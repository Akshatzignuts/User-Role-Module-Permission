@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'Permission')

@section('content')
<div class="card">
    <h3 class="card-header">Permissions</h3>
    <div class="table-responsive text-nowrap">
        <a href="{{route('permission-add')}}" class="btn btn-primary">Add permission</a>
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Permission Name</th>
                    <th>Description</th>
                    <th>Is_Active</th>
                    <th colspan=2>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                {{--    {{$permissions}} --}}
                <tr>
                    <td><strong></strong></td>
                    <td></td>
                    <td></td>
                    <td> <a href="" class="btn btn-primary">Edit</a></td>
                    <td> <a href="" class="btn btn-danger">Delete</a></td>
                </tr>
        </table>
    </div>
</div>
@endsection
<style>
    .btn {
        margin: 10px;


    }

    .card {
        width: 90%;

    }

</style>
