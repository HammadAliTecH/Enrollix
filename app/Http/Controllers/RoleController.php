<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Pest\Support\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $roles = Role::with('permissions')->get();
      return view('pages.previlages.role_permission' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $permissions = $request->permissions;
       $role = Role::create([
        'name'  => $request->role_name
       ]);
       $role->permissions()->sync($permissions);
       return redirect()->route('add_role')
    ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update(['name' => $request->name]);
         return redirect()->back()->with('success','Role Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
          return redirect()->back()->with('success','Role Deleted SuccessFully');
    }


    //EDIT PERMISSIONS
    public function edit_permissions(Request $request)
    {
         $role = Role::find($request->id);
         $role->permissions()->sync($request->permissions);
         return redirect()->back()->with('success','Permissions Updated SuccessFully');
    }
    //SHOW ROLES ON USER PAGE 
    public function show_role(){
     $roles = Role::with('permissions')->get();
      return view('pages.previlages.user' , compact('roles'));
    }
}
