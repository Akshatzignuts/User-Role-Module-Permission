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
                <h3 class="mb-0">Add Permission </h3>
            </div>
            <div class="card-body">
                <form action="{{route('permission-added')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="basic-default-name" placeholder="Enter Permission Name" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-message" name="description" placeholder="Enter permission description" class="form-control"></textarea>
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
                                            <input type="checkbox" name="addCheckbox{{$module->code}}" class="checkbox" id="addCheckbox" value="{{$module->code}}"><br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="editCheckbox{{$module->code}}" class="checkbox" id="editCheckbox" value="{{$module->code}}"><br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="deleteCheckbox{{$module->code}}" class="checkbox" id="deleteCheckbox" value="{{$module->code}}"> <br>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="viewCheckbox{{$module->code}}" class="checkbox" id="viewCheckbox" value="{{$module->code}}"><br>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-all').change(function() {
                var isChecked = $(this).prop('checked');
                $('.checkbox').prop('checked', isChecked);
            });

            $('.checkbox').change(function() {
                var totalCheckboxes = $('.checkbox').length;
                var checkedCheckboxes = $('.checkbox:checked').length;
                $('#select-all').prop('checked', totalCheckboxes === checkedCheckboxes);
            });
        });

    </script>
    @endsection
    <style>
        .btn-primary {
            margin-top: 10px;
            margin-left: 300px;
        }

    </style>
