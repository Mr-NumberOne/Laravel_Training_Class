<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(25);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Permission::select('group')->distinct()->get();

        return view('roles.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:roles,name,".$request->id,
        ]);
        $role = Role::UpdateOrCreate(
            ["id"=>$request->id],
            [
                'name' => $request->name,

            ]);
        $role->syncPermissions($request->permissions);
        toastr()->success("Operation Completed");
        return redirect()->route('roles.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Role $role)
    {
        $groups = Permission::select('group')->distinct()->get();
        return view('roles.create', compact('groups', 'role'));
    }

    /**

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        toastr()->success("deleted successfully");
        return redirect()->route('roles.index');
    }
}
