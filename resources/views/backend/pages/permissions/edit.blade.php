@extends('backend.layouts.master')

@section('title', 'Edit Permission')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Permission</li>
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
                        <h3 class="card-title">Edit Permission</h3>
                        <a href="{{route('permissions.index')}}" class="btn btn-secondary float-right"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('permissions.update', $permission->id)}}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Permission Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$permission->name}}"
                                        name="name" placeholder="Enter role name">
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="group_name">Permission Group</label>
                                    <input type="text" class="form-control" id="group_name"
                                        value="{{$permission->group_name}}" name="group_name" placeholder="Enter role name">
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