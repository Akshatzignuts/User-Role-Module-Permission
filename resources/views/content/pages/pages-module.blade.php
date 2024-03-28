@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')

@section('title', 'Module')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="search-container">

        <form action="{{route('modules')}}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" value="{{$search}}" placeholder="Search Module">
            <button type="submit" class="search-button">Search</button>
        </form>


        <div class="filter">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('modules')}}">All</a></li>
                <li><a class="dropdown-item" href="{{route('modules' , ['filter' => 'active'])}}">Active</a></li>
                <li><a class="dropdown-item" href="{{route('modules' , ['filter' => 'deactive'])}}">Deactive</a></li>
            </ul>
        </div>
    </div>


    <h2>Module List</h2>

    @if(count($modules) === 0 && $search)
    <p class="no-results-message">No search matched for "{{ $search }}".</p>
    @endif

    <ul class="module-list">
        <li class="module">
            @foreach($modules as $module)
            <div class="module-header"> {{$module->name}}</div>
            <div class="module-details">
                <table>
                    <tr>
                        <th>Main Module</th>
                        <th>Description</th>
                        <th>Is_Active</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>{{$module->name}}</td>
                        <td>{{$module->description}}</td>
                        <td>
                            <form id="toggleModuleForm" method="POST" action="{{ url('/modules/') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="module_code" value="{{ $module->code }}">
                                <label class="switch">
                                    <input type="checkbox" name="is_active" class="switch-input" id="is_active_checkbox" {{ $module->is_active ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </form>
                        </td>
                        <td><a href="{{ url('module/edit/' . $module->code) }}" class="edit-button">Edit</a></td>
                    </tr>
                    <tr>
                        <th>Sub Module</th>
                        <th>Description</th>
                        <th>Is_Active</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($module->submodules as $submodule)
                    <tr>
                        <td>{{$submodule->name}}</td>
                        <td>{{$submodule->description}}</td>
                        <td>
                            <form id="toggleModuleForm" method="POST" action="{{ url('/modules/') }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="module_code" value="{{ $submodule->code }}">
                                <label class="switch">
                                    <input type="checkbox" name="is_active" class="switch-input" id="is_active_checkbox" {{ $submodule->is_active ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </form>
                        </td>
                        <td><a href="{{ url('module/edit/' . $submodule->code) }}" class="edit-button">Edit</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endforeach

        </li>
        </table>
        </div>
        </div>
        @if(session('success'))
        <div id="alert-success" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('alert-success').style.display = 'none';
            }, 1000);

        </script>
        <script>
            document.querySelectorAll('.module-header').forEach(header => {
                header.addEventListener('click', () => {
                    const moduleDetails = header.nextElementSibling;
                    moduleDetails.style.display = moduleDetails.style.display === 'block' ? 'none' : 'block';
                });
            });

        </script>

        <script>
            $(document).ready(function() {
                $('.switch-input').change(function() {
                    var isChecked = $(this).prop('checked');
                    var moduleCode = $(this).closest('form').find('input[name="module_code"]').val();
                    var formData = {
                        module_code: moduleCode
                        , is_active: isChecked ? 1 : 0
                    };

                    // Send AJAX request
                    $.ajax({
                        type: "PUT"
                        , url: $(this).closest('form').attr('action')
                        , data: formData
                        , success: function(response) {
                            console.log(response);
                        }
                        , error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    , });
                });
            });

        </script>

</body>
</html>
@endsection
<style>
    /* Add your CSS styles here */
    .module-list {
        list-style-type: none;
        padding: 0;
    }

    .module {
        background-color: #f9f9f9;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .module-header {
        background-color: #4572DA;
        margin: 5px;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    .module-details {
        padding: 20px;
        display: none;
        border: 1px solid #ddd;
    }

    .no-results-message {
        color: #6c757d;
        font-size: 2rem;
        margin-top: 10rem;
        text-align: center;
    }

    .module-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .module-details th,
    .module-details td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    .module-details th {
        background-color: #f2f2f2;
    }

    .edit-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        /* Added for link behavior */
        transition: background-color 0.3s ease;
    }

    .edit-button:hover {
        background-color: #0056b3;
    }

    h2 {
        justify-content: center;
        text-align: center;
    }



    /* Search bar styling */

    .search-input {
        width: 300px;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 20px;
        outline: none;
        font-size: 16px;
    }

    .search-container {
        display: flex;

    }

    .filter {
        padding: 15px;
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




    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .search-form {
        display: flex;
        align-items: center;
    }


    /* Style for the search input */
    .search-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        font-size: 16px;
    }

    /* Style for the search button */
    .search-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    /* Style for the button on hover */
    .search-button:hover {
        background-color: #0056b3;
    }

</style>
