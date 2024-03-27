@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Module')
@section('content')
<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Edit Permission </h3>
            </div>
            <div class="card-body">
                <form action="{{url('permission/edited/' . $permission->id)}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="basic-default-name" placeholder="Enter Permission Name" value='{{$permission->name}}' required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-message" name="description" placeholder="Enter permission description" class="form-control">{{$permission->description}}</textarea>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Modules</h5>
                        <div class="table-responsive text-nowrap">

                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Modules/Submodules</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <th>View</th>
                                        <th>All</th>
                                    </tr>
                                </thead>
                                @foreach($modules as $module)
                                @if ($module->is_active)
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td><strong>{{$module->name}}</strong></td>
                                        <td>
                                            <input type="checkbox" name="addCheckbox[add]" id="addCheckbox" {{ old('permissions.add') ? 'checked' : '' }}><br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="editCheckbox" id="editCheckbox" value=""><br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="deleteCheckbox" id="deleteCheckbox" value=""> <br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="viewCheckbox" id="viewCheckbox" value=""><br>
                                        </td>

                                    </tr>

                                </tbody>
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

    </script>
    @endsection
    <style>
        .btn-primary {
            margin-top: 10px;
            margin-left: 300px;
        }

    </style>
