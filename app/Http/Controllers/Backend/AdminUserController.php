<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(!empty(Auth::guard('admin')->check())){
        //     return redirect()->route('admin.dashboard');
        // }
        
        $users = Admin::all();
        return view('backend.pages.admin_users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.admin_users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($request->roles){
            // $user->assignRole($request->roles);
            $user->syncRoles($request->roles);
        }
        
        return redirect()->route('admin_users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admin_users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Admin::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->roles()->detach();
        if($request->roles){
            //$user->assignRole($request->roles);
            $user->syncRoles($request->roles);
        }
        
        return redirect()->route('admin_users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Admin::findOrFail($id);

        if(!is_null($user)){
            // $role->permissions()->detach();
            // $role->users()->detach();
            $user->delete();
        }  
        return redirect()->route('admin_users.index');
    }
}
