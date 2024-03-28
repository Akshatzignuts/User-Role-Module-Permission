@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Role')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<div class="search-container">
    <form action="" method="GET" class="search-form">
        <input type="text" name="search" class="search-input" value="{{$search}}" placeholder="Search Module">
        <button type="submit" class="bi bi-search icon" style="font-size: 24px;"></button>
    </form>
    <div class="filter">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('role-display')}} " class="{{ !$filter ? 'active' : '' }}">All</a></li>
            <li><a class="dropdown-item" href="{{route('role-display' , ['filter' => 'activated'])}}" class="{{ $filter === 'activated' ? 'active' : '' }}">Activated</a></li>
            <li><a class="dropdown-item" href="{{route('role-display' , ['filter' => 'deactivated'])}}" class="{{ $filter === 'deactivated' ? 'active' : '' }}">Deactivated</a></li>
        </ul>
    </div>

    <a href="{{url('/role/add/')}}" class="btn btn-success">Add Role</a>
</div>
@if(count($roles) === 0 && $search)
<p class="no-results-message">No search matched for "{{ $search }}".</p>
@else
<div class="card">
    <h3 class="card-header">Roles</h3>
    <div class="table-responsive text-nowrap">
        <div class="add-button">
        </div>
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th>Role Name</th>
                    <th>Description</th>
                    <th>Is_Active</th>
                    <th colspan=2>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($roles as $role)
                <tr>
                    <td><strong>{{$role->name}}</strong></td>
                    <td>{{$role->description}}</td>
                    <td>
                        <form id="toggleRoleForm" method="POST" action="{{url('/role/')}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="role_id" value="{{ $role->id }}">
                            <label class="switch">
                                <input type="checkbox" name="is_active" class="switch-input toggle-switch" {{ $role->is_active ? 'checked' : '' }}>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                            </label>
                        </form>
                    </td>
                    <td> <a href="{{url('role/edit/' . $role->id)}}" class="bi bi-pencil-square"></a></td>
                    <td>
                        <form action="{{url('/role/delete/' . $role->id)}}">
                            <a href="{{url('/role/delete/' . $role->id)}}" onclick="return confirm('Are you sure you want to delete this course?')"><i class="bi bi-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endif
<script>
    $(document).ready(function() {
        $('.toggle-switch').change(function() {
            var isChecked = $(this).prop('checked');
            var roleId = $(this).closest('form').find('input[name="role_id"]').val();

            // Send AJAX request
            $.ajax({
                type: "PUT"
                , url: "{{ url('/role/') }}"
                , data: {
                    role_id: roleId
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
    .icon {
        color: #0000ff;
    }

    .btn-success {
        margin-left: 800px;
        margin-bottom: 10px;
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

    .no-results-message {
        color: #6c757d;
        font-size: 2rem;
        margin-top: 10rem;
        text-align: center;
    }

</style>
