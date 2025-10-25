<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'description' => 'nullable|string|max:255',
        ]);
        $request['guard_name'] = "web";

        Role::create($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()
        ->groupBy(function ($perm) {
            return explode(' ', $perm->name)[1] ?? 'otros';
        });
        return view('roles.permissions', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
{
    $request->validate([
        'name' => 'required|string|max:50|unique:roles,name,' . $role->id,
        'description' => 'nullable|string|max:255',
    ]);

    $role->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    $role->syncPermissions($request->input('permissions', []));

    return redirect()->route('roles.index')
        ->with('success', 'Rol y permisos actualizados correctamente.');
}

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }
}
