@extends('backend.layouts.master')

@section('title', 'Create User')

@section('css')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add New User</h3>
                        <a href="{{route('admin_users.index')}}" class="btn btn-secondary float-right"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin_users.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name')}}"
                                        name="name" placeholder="Enter full name">
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">User Email</label>
                                    <input type="email" class="form-control" id="email" value="{{old('email')}}"
                                        name="email" placeholder="Enter email">
                                    @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">User Password</label>
                                    <input type="password" class="form-control" id="password" value="{{old('password')}}"
                                        name="password" placeholder="Enter password">
                                    @error('password')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}"
                                        name="password_confirmation" placeholder="Enter confirm password">
                                    @error('confirm_password')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="roles">Assign Role</label>
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection