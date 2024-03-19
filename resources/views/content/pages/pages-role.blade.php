@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Role')
@section('content')
<a href="{{url('role/add')}}" class="btn btn-primary">Add Role</a>
@endsection
