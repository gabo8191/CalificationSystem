<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function create()
    {
        $permissions = Permission::all();
        return view('Roles.crear', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create($validatedData);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.show')->with('status', 'Rol creado con éxito');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Roles.editar', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role->update($validatedData);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.show')->with('status', 'Rol actualizado con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.show')->with('status', 'Rol eliminado con éxito');
    }

    public function show()
    {
        $roles = Role::all();
        return view('Roles.show', compact('roles'));
    }
    
}
