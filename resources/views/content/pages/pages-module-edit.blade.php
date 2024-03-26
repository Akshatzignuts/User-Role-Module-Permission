<!-- edit.blade.php -->

@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Module Edit')
@section('content')

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">

            <div class="card-body">
                <form method="POST" action="{{url('/module/edited/' . $module->code)}}">
                    @csrf
                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light"></span>Edit Module</h4>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Module Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{$module->name}}" id="basic-default-name" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                        <div class="col-sm-10">
                            <textarea id="basic-default-message" class="form-control">{{$module->description}}</textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
