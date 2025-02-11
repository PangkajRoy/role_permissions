@extends('backend.layouts.master')

@section('title', 'Edit Role')

{{-- @section('css')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection --}}

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="card p-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
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
                        <h3 class="card-title">Edit Role</h3>
                        <a href="{{route('roles.index')}}" class="btn btn-secondary float-right"><i
                                class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('roles.update', $role->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Role Name</label>
                                <input type="text" class="form-control" id="name" value="{{$role->name}}" name="name"
                                    placeholder="Enter role name">
                                @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{App\Models\Admin::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        @php
                                            $permissions = App\Models\Admin::getpermissionsByGroupName($group->name);
                                            $permissionByGroup = App\Models\Admin::roleHasPermissions($role, $permissions);
                                            $j = 1;
                                        @endphp
                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="{{ $i }}Management" value="{{$group->name}}"
                                                    onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{$permissionByGroup ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="checkPermissionGroup">{{$group->name}}</label>
                                            </div>
                                        </div>
                                        <div class="col-9 role-{{ $i }}-management-checkbox">                                            
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}} name="permissions[]"
                                                        id="checkPermission{{$permission->id}}" value="{{$permission->name}}" 
                                                        onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})">
                                                    <label class="form-check-label"
                                                        for="checkPermission{{$permission->id}}">{{$permission->name}}</label>
                                                </div>
                                                @php $j++; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    @php $i++; @endphp
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
    @include('backend.pages.roles.partials.script')
@endsection