@extends('backend.layouts.master')

@section('title', 'Create Permission')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Permission</li>
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
                        <h3 class="card-title">Add New Permission</h3>
                        <a href="{{route('permissions.index')}}" class="btn btn-secondary float-right"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('permissions.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Permission Name</label>
                                    <input type="text" class="form-control" id="name" value="{{old('name')}}"
                                        name="name" placeholder="Enter role name">
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="group_name">Permission Group</label>
                                    <input type="text" class="form-control" id="group_name"
                                        value="{{old('group_name')}}" name="group_name" placeholder="Enter role name">
                                    @error('group_name')
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