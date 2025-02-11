<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller implements HasMiddleware
{
    
    public static function middleware(): array
    {
        $roles = Role::orderby('id', 'asc')->get();
        $roleNames = $roles->pluck('name'); // Use pluck to get an array of names

        return [
            // Join role names with a pipe separator
            'role:' . implode('|', $roleNames->toArray()),
            
            new Middleware('permission:View Permission', only: ['index']),
            new Middleware('permission:Create Permission', only: ['create']),
            new Middleware('permission:Edit Permission', only: ['edit']),
            new Middleware('permission:Delete Permission', only: ['destroy']),
        ];
    }



    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->get();
        return view('backend.pages.permissions.index', [
            'permissions' => $permissions
        ]);
    }


    public function create ()
    {
        return view('backend.pages.permissions.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|unique:permissions|min:3', 
        ]);

        if($validator->passes()){
            Permission::create(['name' => $request->name, 'guard_name' => 'admin', 'group_name' => $request->group_name]);
            return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
        }else{
            return redirect()->route('permissions.create')->withErrors($validator)->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permissions.edit', [
            'permission' => $permission
        ]);
    }


    //This method update permission
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(), [
           'name' => 'required|min:3|unique:permissions,name,'.$id.'id', 
        ]);

        if($validator->passes()){
            $permission->name = $request->name;
            $permission->group_name = $request->group_name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        }else{
            return redirect()->route('permissions.create', $id)->withErrors($validator)->withInput();
        }
        
    }

    //This method delete permission
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        if($permission == null)
        {
            session()->flash('error', 'Permission not found');
            return response()->json([
                'status' => false
            ]);
        }
        $permission->delete();

        session()->flash('success', 'Permission deleted successfully');
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }

}
