@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')
@section('title', 'Permission')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="search-container">
    <form action="{{route('permission-display')}}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" value="{{$search}}" placeholder="Search Module">
        <button type="submit" class="bi bi-search" style="font-size: 24px;"></button>
    </form>
    <div class="filter">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('permission-display')}} " class="{{ !$filter ? 'active' : '' }}">All</a></li>
            <li><a class="dropdown-item" href="{{route('permission-display' , ['filter' => 'activated'])}}" class="{{ $filter === 'activated' ? 'active' : '' }}">Activated</a></li>
            <li><a class="dropdown-item" href="{{route('permission-display' , ['filter' => 'deactivated'])}}" class="{{ $filter === 'deactivated' ? 'active' : '' }}">Deactivated</a></li>
        </ul>
    </div>

    <a href="{{route('permission-add')}}" class="btn btn-success">Add permission</a>
</div>
@if(count($permissions) === 0 && $search)
<p class="no-results-message">No search matched for "{{ $search }}".</p>
@else
<div class="card">
    <h3 class="card-header">Permissions</h3>
    <div class="table-responsive text-nowrap">
        <div class="add-button">
        </div>
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

                @foreach ($permissions as $permission)
                <tr>
                    <td><strong>{{$permission->name}}</strong></td>
                    <td>{{$permission->description}}</td>
                    <td>
                        <form id="togglePermissionForm" method="POST" action="{{url('/permissions/')}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                            <label class="switch">
                                <input type="checkbox" name="is_active" class="switch-input toggle-switch" {{ $permission->is_active ? 'checked' : '' }}>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                            </label>
                        </form>
                    </td>
                    <td> <a href="{{url('/permission/edit/' . $permission->id)}}" class="bi bi-pencil-square"></a></td>
                    <td>
                        <form action="{{url('/permission/delete/' . $permission->id)}}">
                            <a href="{{url('/permission/delete/' . $permission->id)}}" onclick="return confirm('Are you sure you want to delete this course?')"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach

        </table>
    </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-switch').change(function() {
            var isChecked = $(this).prop('checked');
            var permissionId = $(this).closest('form').find('input[name="permission_id"]').val();

            // Send AJAX request
            $.ajax({
                type: "PUT"
                , url: "{{ url('/permissions') }}"
                , data: {
                    permission_id: permissionId
                    , is_active: isChecked ? 1 : 0
                    , _token: $('input[name="_token"]').val()
                }
                , success: function(response) {
                    console.log(response);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
@endsection
<style>
    .add-button {
        margin-left: 1000px;


    }

    .card {
        width: 90%;

    }

    .search-bar {
        width: 300px;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 20px;
        outline: none;
        font-size: 16px;
    }

    .search-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        font-size: 16px;
    }

    .no-results-message {
        color: #6c757d;
        font-size: 2rem;
        margin-top: 10rem;
        text-align: center;
    }

    .search-container {
        display: flex;

    }

    .filter {
        padding: 15px;
    }

    .search-form {
        display: flex;
        align-items: center;
    }

    .search-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #0056b3;
    }


    .btn-success {
        margin-left: 600px;
        height: 50px;
        padding: 5px 10px;
        font-size: 20px;
    }

</style>
