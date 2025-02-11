<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        $roles = Role::orderby('id', 'asc')->get();
        $roleNames = $roles->pluck('name'); // Use pluck to get an array of names

        return [
            // Join role names with a pipe separator
            'role:' . implode('|', $roleNames->toArray()),
            
            new Middleware('permission:View Role', only: ['index']),
            new Middleware('permission:Create Role', only: ['create']),
            new Middleware('permission:Edit Role', only: ['edit']),
            new Middleware('permission:Delete Role', only: ['destroy']),
        ];
    } 
    public function index(){
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    public function create(){
        $all_permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroup();
        return view('backend.pages.roles.create', compact('all_permissions', 'permission_groups'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:roles',
        ]); 
        $role = Role::create(['name' => $request->name]);
        $permission = $request->input('permissions');
        if (!empty($permission)) {
            $role->syncPermissions($permission);
        }

        return redirect()->route('roles.index');
    }

    public function edit($id){
        $role = Role::findById($id);
        $all_permissions = Permission::all();
        $permission_groups = Admin::getpermissionGroup();
        return view('backend.pages.roles.edit', compact('role','all_permissions', 'permission_groups'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
        ]); 
        $role = Role::findById($id);
        $role->update(['name' => $request->name]);
        $permission = $request->input('permissions');
        if (!empty($permission)) {
            $role->syncPermissions($permission);
        }

        return redirect()->route('roles.index');
    }

    public function destroy($id){
        $role = Role::findById($id);

        if(!is_null($role)){
            // $role->permissions()->detach();
            // $role->users()->detach();
            $role->delete();
        }  
        return redirect()->route('roles.index');
    }
}
